<?php
/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace YvesUnit\Pyz\Yves\Checkout\Process\Steps;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Pyz\Yves\Application\Business\Model\FlashMessengerInterface;
use Pyz\Yves\Checkout\Dependency\Plugin\CheckoutStepHandlerPluginInterface;
use Pyz\Yves\Checkout\Process\Steps\SummaryStep;
use Spryker\Client\Calculation\CalculationClientInterface;
use Symfony\Component\HttpFoundation\Request;

class SummaryStepTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testExecuteShouldTriggerQuoteRecalculation()
    {
        $calculationClientMock = $this->createCalculationClientMock();
        $calculationClientMock->expects($this->once())->method('recalculate');

        $summaryStep = $this->createSummaryStep($calculationClientMock);
        $summaryStep->execute($this->createRequest(), new QuoteTransfer());
    }

    /**
     * @return void
     */
    public function testPostConditionShouldReturnWhenQuoteReadyForSummaryDisplay()
    {
        $calculationClientMock = $this->createCalculationClientMock();
        $summaryStep = $this->createSummaryStep($calculationClientMock);

        $quoteTransfer = new QuoteTransfer();
        $quoteTransfer->setBillingAddress(new AddressTransfer());

        $paymentTransfer = new PaymentTransfer();
        $paymentTransfer->setPaymentProvider('test');

        $quoteTransfer->setPayment($paymentTransfer);
        $quoteTransfer->setShipment(new ShipmentTransfer());

        $this->assertTrue($summaryStep->postCondition($quoteTransfer));
    }

    /**
     * @return void
     */
    public function testRequireInputShouldBeTrue()
    {
        $calculationClientMock = $this->createCalculationClientMock();
        $summaryStep = $this->createSummaryStep($calculationClientMock);

        $this->assertTrue($summaryStep->requireInput(new QuoteTransfer()));
    }

    /**
     * @return \Pyz\Yves\Checkout\Process\Steps\ShipmentStep
     */
    protected function createSummaryStep($calculationClientMock)
    {
        return new SummaryStep(
            $this->createFlashMessengerMock(),
            $calculationClientMock,
            'shipment',
            'escape_route'
        );
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    protected function createRequest()
    {
        return Request::createFromGlobals();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Pyz\Yves\Application\Business\Model\FlashMessengerInterface
     */
    protected function createFlashMessengerMock()
    {
        return $this->getMock(FlashMessengerInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Spryker\Client\Calculation\CalculationClientInterface
     */
    protected function createCalculationClientMock()
    {
        return $this->getMock(CalculationClientInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Pyz\Yves\Checkout\Dependency\Plugin\CheckoutStepHandlerPluginInterface
     */
    protected function createShipmentMock()
    {
        return $this->getMock(CheckoutStepHandlerPluginInterface::class);
    }

}
