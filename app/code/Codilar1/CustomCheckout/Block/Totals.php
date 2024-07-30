<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Codilar1\CustomCheckout\Block;

use Magento\Framework\DataObject;
use Magento\Sales\Model\Order;

class Totals extends \Magento\Sales\Block\Order\Totals
{
    /**
     * Initialize order totals array
     *
     * @return $this
     */

    protected function _initTotals()
    {
        $source = $this->getSource();

        $this->_totals = [];
        $this->_totals['subtotal'] = new \Magento\Framework\DataObject(
            ['code' => 'subtotal', 'value' => $source->getSubtotal(), 'label' => __('Subtotal')]
        );

        $this->_totals['custom_tax'] = new \Magento\Framework\DataObject(
            ['code' => 'custom_tax', 'value' => $source->getCustomTaxAmount(),
                'label' => __('Custom Tax('.intval($source->getBaseCustomTaxAmount()).'%)')]
        );

        /**
         * Add discount
         */
        if ((double)$this->getSource()->getDiscountAmount() != 0) {
            if ($this->getSource()->getDiscountDescription()) {
                $discountLabel = __('Discount (%1)', $source->getDiscountDescription());
            } else {
                $discountLabel = __('Discount');
            }
            $this->_totals['discount'] = new \Magento\Framework\DataObject(
                [
                    'code' => 'discount',
                    'field' => 'discount_amount',
                    'value' => $source->getDiscountAmount(),
                    'label' => $discountLabel,
                ]
            );
        }

        $this->addShippingTotal($source);

        $this->_totals['grand_total'] = new \Magento\Framework\DataObject(
            [
                'code' => 'grand_total',
                'field' => 'grand_total',
                'strong' => true,
                'value' => $source->getGrandTotal(),
                'label' => __('Grand Total'),
            ]
        );
        /**
         * Base grandtotal
         */
        if ($this->getOrder()->isCurrencyDifferent()) {
            $this->_totals['base_grandtotal'] = new \Magento\Framework\DataObject(
                [
                    'code' => 'base_grandtotal',
                    'value' => $this->getOrder()->formatBasePrice($source->getBaseGrandTotal()),
                    'label' => __('Grand Total to be Charged'),
                    'is_formated' => true,
                ]
            );
        }
        return $this;
    }

    /**
     * Add shipping total
     *
     * @param Order|Order\Invoice $source
     * @retrurn void
     */
    private function addShippingTotal($source)
    {
        if (!$source->getIsVirtual()
            && ($source->getShippingAmount() !== null
                || $source->getShippingDescription())
        ) {
            $shippingLabel = __('Shipping & Handling');

            if (!isset($this->_totals['discount'])) {
                if ($source->getCouponCode()) {
                    $shippingLabel .= " ({$source->getCouponCode()})";
                } elseif ($source->getDiscountDescription()) {
                    $shippingLabel .= " ({$source->getDiscountDescription()})";
                }
            }
            $this->_totals['shipping'] = new DataObject(
                [
                    'code' => 'shipping',
                    'field' => 'shipping_amount',
                    'value' => $source->getShippingAmount(),
                    'label' => $shippingLabel,
                ]
            );
        }
    }
}

