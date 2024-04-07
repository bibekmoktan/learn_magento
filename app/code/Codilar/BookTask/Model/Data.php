<?php


namespace Codilar\BookTask\Model;


use Magento\Framework\Model\AbstractModel;

class Data extends AbstractModel
{
    protected $_eventPrefix = 'book_info';
    protected function _construct()
    {
        $this->_init('Codilar\BookTask\Model\ResourceModel\Data');
    }
}
