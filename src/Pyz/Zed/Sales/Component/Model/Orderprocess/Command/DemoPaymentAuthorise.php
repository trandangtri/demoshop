<?php

use Generated\Shared\Library\TransferLoader;

class Pyz_Zed_Sales_Component_Model_Orderprocess_Command_DemoPaymentAuthorise extends \ProjectA_Zed_Sales_Component_Model_Orderprocess_CommandAbstract implements
    \ProjectA_Zed_Sales_Component_Interface_OrderCommand,
    \Generated\Zed\Payment\Component\Dependency\PaymentFacadeInterface,
    \ProjectA\Zed\Payment\Component\Model\PaymentConstantsInterface
{

    use \Generated\Zed\Payment\Component\Dependency\PaymentFacadeTrait;

    /**
     * @param \ProjectA_Zed_Sales_Persistence_PacSalesOrder $orderEntity
     * @param \ProjectA_Zed_Sales_Component_Interface_ContextCollection $context
     * @return \ProjectA_Zed_Payment_Component_Model_Response
     */
    public function __invoke(\ProjectA_Zed_Sales_Persistence_PacSalesOrder $orderEntity, \ProjectA_Zed_Sales_Component_Interface_ContextCollection $context)
    {
        $paymentTransfer = TransferLoader::loadSalesPayment();
        $context['Transfer_Sales_Order_Payment'] = $paymentTransfer;
        $date = new DateTime();

        $response = new \ProjectA\Zed\Payment\Component\Model\PaymentResponse(true);
        $response->setMethod('demo method');
        $response->setProvider('demo provider');
        $response->setTransaction('demo-' . sha1(time()));
        $context[self::PAYMENT_TRANSACTION_RESPONSE_KEY] = $response;

        $paymentStorage = $this->facadePayment->getPaymentStorageContainer();
        $paymentStorage->setMethod($response->getMethod());
        $paymentStorage->setProvider($response->getProvider());
        $paymentStorage->setTransaction($response->getTransaction());
        $paymentStorage->setOrder($orderEntity);
        $payment = $this->facadePayment->storePayment($paymentStorage);

        $transactionStorage = $this->facadePayment->getPaymentTransactionStorageContainer();
        $transactionStorage->setEvent('authorise');
        $transactionStorage->setIsOutbound(true);
        $transactionStorage->setMessage('Demo Authorisation');
        $transactionStorage->setIsSuccess(true);
        $transactionStorage->setEventDate($date->format('Y-m-d h:i:s'));
        $transactionStorage->setPayment($payment);
        $this->facadePayment->addPaymentTransaction($transactionStorage);

        $this->addNote('demo payment authorisation performed', $orderEntity, $response->isSuccess());
        return $response;
    }
}
