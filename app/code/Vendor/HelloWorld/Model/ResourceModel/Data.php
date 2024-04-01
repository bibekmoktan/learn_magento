<?php
namespace Vendor\HelloWorld\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Data extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('book_table', 'book_id');
    }
}
