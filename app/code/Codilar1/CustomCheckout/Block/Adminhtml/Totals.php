<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Codilar1\CustomCheckout\Block\Adminhtml;

use Magento\Framework\DataObject;

class Totals extends \Magento\Sales\Block\Adminhtml\Order\Invoice\Totals
{
    /**
     * Initialize order totals array
     *
     * @return $this
     */
    protected function _initTotals()
    {
        parent::_initTotals();
        $order = $this->getSource();

        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/test.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info('Order Information: ' . print_r($order->debug(), true));

        $this->_totals['custom_tax'] = new DataObject(
            [
                'code' => 'custom_tax',
                'value' => $order->getCustomTaxAmount(),
                'base_value' => $order->getBaseSubtotal(),
                'label' => __('Custom Tax ('.intval($order->getBaseCustomTaxAmount()).'%)'),
            ]
        );
        return $this;
    }
}
