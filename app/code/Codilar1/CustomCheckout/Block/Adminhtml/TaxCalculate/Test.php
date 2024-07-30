<?php

namespace Codilar1\CustomCheckout\Block\Adminhtml\TaxCalculate;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Model\Order;

class Test extends Template
{
    /**
     * @var Order
     */
    protected $_order;

    /**
     * @var \Magento\Framework\DataObject
     */
    protected $_source;

    /**
     * Constructor
     *
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Get source data
     *
     * @return \Magento\Framework\DataObject
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
            $this->_order = $parent->getOrder();
            $this->_source = $parent->getSource();
            $title = 'Custom Tax';
            $store = $this->getStore();

            // Check if custom tax amount exists and add it to the totals
            if ($this->_order && $this->_order->getCustomTaxAmount() != 0) {
                $customAmount = new \Magento\Framework\DataObject(
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
     * @return \Magento\Store\Model\Store
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
