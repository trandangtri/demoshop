<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Sales\Communication\Plugin\Oms\Command\Mail;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Shared\Library\Currency\CurrencyManager;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Command\CommandByOrderInterface;

class UnderpaidReminderMail implements CommandByOrderInterface
{

    /**
     * @param array $orderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array
     */
    public function run(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        $transactionStatusRequest = $data[StateMachineConstants::STATEMACHINE_CONTEXT_TRANSACTION_STATUS_REQUEST];
        $currencyManager = CurrencyManager::getInstance();
        $balance = $transactionStatusRequest->getBalance();
        $grandTotal = $orderEntity->getGrandTotal();

        $underpaidAmount = abs($balance);
        $missingAmount = $grandTotal - $underpaidAmount;

        $underpaidAmount = $currencyManager->convertCentToDecimal($underpaidAmount);
        $underpaidAmount = $currencyManager->format($underpaidAmount);

        $missingAmount = $currencyManager->convertCentToDecimal($missingAmount);
        $missingAmount = $currencyManager->format($missingAmount);

        $additionalMailData = [
            'underpaid_amount' => $underpaidAmount,
            'missing_amount' => $missingAmount,
        ];

        $mailTransfer = $this->facadeMail->buildUnderpaidPaymentTransfer(MailTypesConstantInterface::UNDERPAID_CONFIRMATION, $orderEntity, $additionalMailData, false);
        $result = $this->facadeMail->sendMail($mailTransfer);
        $this->handleResponse($result, $mailTransfer, $orderEntity);

        return [];
    }

}
