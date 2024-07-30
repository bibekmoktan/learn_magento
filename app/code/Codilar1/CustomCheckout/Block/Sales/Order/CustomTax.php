<?php

namespace Codilar1\CustomCheckout\Block\Sales\Order;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Model\Order;
use Magento\Framework\DataObject;

class CustomTax extends Template
{
    /**
     * @var Order
     */
    protected $_order;

    /**
     * @var DataObject
     */
    protected $_source;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Order $order
     * @param array $data
     */
    public function __construct(
        Context $context,
        Order $order,
        array $data = []
    ) {
        $this->_order = $order;
        parent::__construct($context, $data);
    }

    /**
     * Get source data
     *
     * @return DataObject
     */
    public function getSource()
    {
        return $this->_source;
    }

    /**
     * Display full summary
     *
     * @return bool
     */
    public function displayFullSummary()
    {
        return true;
    }

    /**
     * Initialize custom totals
     *
     * @return $this
     */
    public function initTotals()
    {

        $parent = $this->getParentBlock();
        if ($parent) {
            $this->_source = $parent->getSource();
            $title = 'Custom Tax';

            // Check if custom tax amount exists and add it to the totals
            if ($this->_order && $this->_order->getCustomTaxAmount() != 0) {
                $customAmount = new DataObject(
                    [
                        'code' => 'custom_tax',
                        'strong' => false,
                        'value' => $this->_order->getCustomTaxAmount(),
                        'label' => __($title),
                    ]
                );
                $parent->addTotal($customAmount, 'custom_tax');
            }
        }
        return $this;
    }

    /**
     * Get order store object
     *
     * @return \Magento\Store\Model\Store|null
     */
    public function getStore()
    {
        return $this->_order ? $this->_order->getStore() : null;
    }

    /**
     * Get order object
     *
     * @return Order|null
     */
    public function getOrder()
    {
        return $this->_order;
    }

    /**
     * Get label properties
     *
     * @return array
     */
    public function getLabelProperties()
    {
        return $this->getParentBlock()->getLabelProperties();
    }

    /**
     * Get value properties
     *
     * @return array
     */
    public function getValueProperties()
    {
        return $this->getParentBlock()->getValueProperties();
    }
}
