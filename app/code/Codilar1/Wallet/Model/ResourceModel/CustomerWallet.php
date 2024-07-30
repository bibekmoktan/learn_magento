<?php
namespace Codilar1\Wallet\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CustomerWallet extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('customer_wallet', 'wallet_id');
    }
}
