<?php
namespace Codilar1\Wallet\Model;

use Magento\Framework\Model\AbstractModel;
use Codilar1\Wallet\Api\Data\CustomerWalletInterface;

class CustomerWallet extends AbstractModel implements CustomerWalletInterface
{
    protected function _construct()
    {
        $this->_init('Codilar1\Wallet\Model\ResourceModel\CustomerWallet');
    }

    public function getId()
    {
        return $this->getData(self::WALLET_ID);
    }

    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    public function getBalance()
    {
        return $this->getData(self::BALANCE);
    }

    public function setId($id)
    {
        return $this->setData(self::WALLET_ID, $id);
    }

    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    public function setBalance($balance)
    {
        return $this->setData(self::BALANCE, $balance);
    }
}
