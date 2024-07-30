<?php

namespace Codilar1\CustomCheckout\Block\Adminhtml\Order;

use Magento\Framework\DataObject;

class Totals extends \Magento\Sales\Block\Adminhtml\Order\Totals
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

        $this->_totals['custom_tax'] = new DataObject(
            [
                'code' => 'custom_tax',
                'value' => $order->getCustomTaxAmount(),
                'base_value' => $order->getBaseSubtotal(),
                'label' => __('Custom Tax('.intval($order->getBaseCustomTaxAmount()).'%)'),
            ]
        );
        return $this;
    }
}
