<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Oms;

use Spryker\Zed\Braintree\Communication\Plugin\Oms\Command\CapturePlugin as BraintreeCapturePlugin;
use Spryker\Zed\Braintree\Communication\Plugin\Oms\Command\AuthorizePlugin as BraintreeAuthorizePlugin;
use Spryker\Zed\Braintree\Communication\Plugin\Oms\Command\RefundPlugin as BraintreeRefundPlugin;
use Spryker\Zed\Braintree\Communication\Plugin\Oms\Command\RevertPlugin as BraintreeRevertPlugin;
use Spryker\Zed\Braintree\Communication\Plugin\Oms\Condition\IsCaptureApprovedPlugin as BraintreeIsCaptureApprovedPlugin;
use Spryker\Zed\Braintree\Communication\Plugin\Oms\Condition\IsAuthorizationApprovedPlugin as BraintreeIsAuthorizationApprovedPlugin;
use Spryker\Zed\Braintree\Communication\Plugin\Oms\Condition\IsRefundApprovedPlugin as BraintreeIsRefundApprovedPlugin;
use Spryker\Zed\Braintree\Communication\Plugin\Oms\Condition\IsReversalApprovedPlugin as BraintreeIsReversalApprovedPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Oms\OmsDependencyProvider as SprykerOmsDependencyProvider;
use Spryker\Zed\Payolution\Communication\Plugin\Oms\Command\CapturePlugin;
use Spryker\Zed\Payolution\Communication\Plugin\Oms\Command\PreAuthorizePlugin;
use Spryker\Zed\Payolution\Communication\Plugin\Oms\Command\ReAuthorizePlugin;
use Spryker\Zed\Payolution\Communication\Plugin\Oms\Command\RefundPlugin;
use Spryker\Zed\Payolution\Communication\Plugin\Oms\Command\RevertPlugin;
use Spryker\Zed\Payolution\Communication\Plugin\Oms\Condition\IsCaptureApprovedPlugin;
use Spryker\Zed\Payolution\Communication\Plugin\Oms\Condition\IsPreAuthorizationApprovedPlugin;
use Spryker\Zed\Payolution\Communication\Plugin\Oms\Condition\IsReAuthorizationApprovedPlugin;
use Spryker\Zed\Payolution\Communication\Plugin\Oms\Condition\IsRefundApprovedPlugin;
use Spryker\Zed\Payolution\Communication\Plugin\Oms\Condition\IsReversalApprovedPlugin;

class OmsDependencyProvider extends SprykerOmsDependencyProvider
{

    /**
     * Overwrite in project
     *
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Oms\Communication\Plugin\Oms\Condition\ConditionInterface[]
     */
    protected function getConditionPlugins(Container $container)
    {
        return [
            'Payolution/IsPreAuthorizationApproved' => new IsPreAuthorizationApprovedPlugin(),
            'Payolution/IsReAuthorizationApproved' => new IsReAuthorizationApprovedPlugin(),
            'Payolution/IsReversalApproved' => new IsReversalApprovedPlugin(),
            'Payolution/IsCaptureApproved' => new IsCaptureApprovedPlugin(),
            'Payolution/IsRefundApproved' => new IsRefundApprovedPlugin(),

            'Braintree/IsAuthorizationApproved' => new BraintreeIsAuthorizationApprovedPlugin(),
            'Braintree/IsReversalApproved' => new BraintreeIsReversalApprovedPlugin(),
            'Braintree/IsCaptureApproved' => new BraintreeIsCaptureApprovedPlugin(),
            'Braintree/IsRefundApproved' => new BraintreeIsRefundApprovedPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Oms\Communication\Plugin\Oms\Command\CommandInterface[]
     */
    protected function getCommandPlugins(Container $container)
    {
        return [
            'Payolution/PreAuthorize' => new PreAuthorizePlugin(),
            'Payolution/ReAuthorize' => new ReAuthorizePlugin(),
            'Payolution/Revert' => new RevertPlugin(),
            'Payolution/Capture' => new CapturePlugin(),
            'Payolution/Refund' => new RefundPlugin(),

            'Braintree/Authorize' => new BraintreeAuthorizePlugin(),
            'Braintree/Revert' => new BraintreeRevertPlugin(),
            'Braintree/Capture' => new BraintreeCapturePlugin(),
            'Braintree/Refund' => new BraintreeRefundPlugin(),
        ];
    }

}
