<?php

namespace Test\HelloWorld\Model\ResourceModel\Data;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Test\HelloWorld\Model\Data;
use Test\HelloWorld\Model\ResourceModel\Data as ItemResource;

class Collection extends AbstractCollection{

    protected $_eventPrefix = 'post';

    protected function _construct()
    {
        $this->_init(Data::class, ItemResource::class);
    }
}
