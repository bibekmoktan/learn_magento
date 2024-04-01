<?php

namespace Test\HelloWorld\Model;

use Magento\Framework\Model\AbstractModel;

class Data extends AbstractModel{

    protected $_eventPrefix = 'post';

    protected function _construct()
    {
        $this->_init(\Test\HelloWorld\Model\ResourceModel\Data::class);
    }
}
