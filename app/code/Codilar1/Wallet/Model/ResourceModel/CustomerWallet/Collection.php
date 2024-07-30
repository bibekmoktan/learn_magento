<?php
namespace Codilar1\Wallet\Model\ResourceModel\CustomerWallet;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Codilar1\Wallet\Model\CustomerWallet;
use Codilar1\Wallet\Model\ResourceModel\CustomerWallet as CustomerWalletResource;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(CustomerWallet::class, CustomerWalletResource::class);
    }
}
