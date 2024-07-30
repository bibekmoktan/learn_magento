<?php

namespace Codilar1\CustomCheckout\Model\Quote\Address\Total;

use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;
use Magento\Quote\Model\Quote;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Quote\Model\QuoteValidator;
use Magento\Store\Model\ScopeInterface;
class CustomTax extends AbstractTotal
{
    protected $quoteValidator;
    protected $checkoutSession;
    protected $scopeConfig;

    public function __construct(
        QuoteValidator $quoteValidator,
        CheckoutSession $checkoutSession,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->quoteValidator = $quoteValidator;
        $this->checkoutSession = $checkoutSession;
        $this->scopeConfig = $scopeConfig;
    }

    public function collect(
        Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total,
    ) {
        parent::collect($quote, $shippingAssignment, $total);
        // Clear previous custom tax value to avoid duplication
        $this->clearValues($total);
        // Calculate custom tax amount
        $customTaxRate = $this->scopeConfig->getValue('custom_tax_section/custom_tax_group/rate', ScopeInterface::SCOPE_STORE);
        $subtotal = $total->getSubtotal();
        $customTaxAmount = ($subtotal * $customTaxRate) / 100;

        $total->setGrandTotal($total->getGrandTotal() + $customTaxAmount);
        $total->setBaseGrandTotal($total->getBaseGrandTotal() + $customTaxAmount);

        // Set custom tax amount to quote for later use
        $quote->setCustomTaxAmount($customTaxAmount);
        $quote->setCustomTaxRate($customTaxRate);
        return $this;
    }
    protected function clearValues(\Magento\Quote\Model\Quote\Address\Total $total)
    {
        $total->setTotalAmount('custom_tax', 0);
        $total->setBaseTotalAmount('custom_tax', 0);
    }
    public function fetch(Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total)
    {
        return [
            'code' => 'custom_tax',
            'title' => __('Custom Tax (%1%)'),
            'value' => $quote->getCustomTaxAmount()
        ];
    }
    public function getLabel()
    {
        return __('Custom Tax');
    }
}
