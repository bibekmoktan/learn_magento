<?php
namespace Codilar1\CustomCheckout\Api\Data;

interface OrderInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const CUSTOM_TAX_AMOUNT = 'custom_tax_amount';
    const CUSTOM_TAX_RATE = 'custom_tax_rate';

    /**
     * Get custom tax amount
     *
     * @return float|null
     */
    public function getCustomTaxAmount();

    /**
     * Set custom tax amount
     *
     * @param float $customTaxAmount
     * @return $this
     */
    public function setCustomTaxAmount($customTaxAmount);

    /**
     * Get custom tax rate
     *
     * @return float|null
     */
    public function getBaseCustomTaxAmount();

    /**
     * Set custom tax rate
     *
     * @param float $customTaxRate
     * @return $this
     */
    public function setCustomTaxRate($customTaxRate);
}
