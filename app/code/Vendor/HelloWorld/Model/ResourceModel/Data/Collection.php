<?php
namespace Vendor\HelloWorld\Model\ResourceModel\Data;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
     function _construct(){
        $this->_init('\Vendor\HelloWorld\Model\Data', '\Vendor\HelloWorld\Model\ResourceModel\Data');
    }
}

