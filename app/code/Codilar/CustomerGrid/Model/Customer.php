<?php
namespace Codilar\CustomerGrid\Model;

use Magento\Framework\Model\AbstractModel;

class Customer extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Codilar\CustomerGrid\Model\ResourceModel\Customer');
    }
}
