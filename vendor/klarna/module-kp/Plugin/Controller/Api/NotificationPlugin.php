<?php
/**
 * This file is part of the Klarna Kp module
 *
 * (c) Klarna AB
 *
 * For the full copyright and license information, please view the NOTICE
 * and LICENSE files that were distributed with this source code.
 */

namespace Klarna\Kp\Plugin\Controller\Api;

use Klarna\Kp\Model\Payment\Kp;
use Klarna\Ordermanagement\Controller\Api\Notification;
use Magento\Sales\Model\Order;

/**
 * Class NotificationPlugin
 *
 * @package Klarna\Kp\Plugin\Controller\Api
 */
class NotificationPlugin
{
    /**
     * @param Notification $subject
     * @param Order        $order
     * @param String       $method
     * @param string       $status
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeSetOrderStatus(
        Notification $subject,
        $order,
        $method,
        $status = null
    ) {
        if (in_array($method, Kp::KLARNA_METHODS)) {
            $method = Kp::METHOD_CODE;
        }
        return [$order, $method, $status];
    }
}
