<?php
namespace Codilar1\CustomCheckout\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Codilar1\CustomCheckout\Api\Data\OrderInterface;

class Order extends AbstractExtensibleModel implements OrderInterface
{

    protected $_eventPrefix = 'sales_order';

    /**
     * @var string
     */
    protected $_eventObject = 'order';

    protected function _construct()
    {
        $this->_init(\Codilar1\CustomCheckout\Model\ResourceModel\Order::class);
    }
    /**
     * Get custom tax amount.
     *
     * @return float|null
     */
    public function getCustomTaxAmount()
    {
        return $this->getData(OrderInterface::CUSTOM_TAX_AMOUNT);
    }
    /**
     * Set custom tax amount.
     *
     * @param float $customTaxAmount
     * @return $this
     */
    public function setCustomTaxAmount($customTaxAmount)
    {
        return $this->setData(self::CUSTOM_TAX_AMOUNT, $customTaxAmount);
    }

    /**
     * Get custom tax amount.
     *
     * @return float|null
     */
    public function getBaseCustomTaxAmount()
    {
        return $this->getData(OrderInterface::CUSTOM_TAX_RATE);
    }
    /**
     * {@inheritdoc}
     */
    public function setCustomTaxRate($customTaxRate)
    {
        return $this->setData(self::CUSTOM_TAX_RATE, $customTaxRate);
    }

}
