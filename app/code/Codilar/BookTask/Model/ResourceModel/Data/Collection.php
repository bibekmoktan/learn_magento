<?php


namespace Codilar\BookTask\Model\ResourceModel\Data;


use Codilar\BookTask\Model\Data;
use Codilar\BookTask\Model\ResourceModel\Data as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Crud\Test\Model\Data', 'Crud\Test\Model\ResourceModel\Data');
    }
}
