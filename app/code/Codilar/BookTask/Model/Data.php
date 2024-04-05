<?php


namespace Codilar\BookTask\Model;


use Magento\Framework\Model\AbstractModel;

class Data extends AbstractModel
{
    protected $_eventPrefix = 'info';
    protected function _construct()
    {
        $this->_init('\Crud\Test\Model\ResourceModel\Data');
    }
}
