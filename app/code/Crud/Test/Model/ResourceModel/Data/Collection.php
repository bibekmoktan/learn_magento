<?php


namespace Crud\Test\Model\ResourceModel\Data;


use Crud\Test\Model\Data;
use Crud\Test\Model\ResourceModel\Data as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Data::class, ResourceModel::class);
    }
}
