<?php
namespace Codilar1\CustomCheckout\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Order extends AbstractDb
{
protected function _construct()
{
$this->_init('sales_order', 'entity_id'); // 'sales_order' is the table name and 'entity_id' is the primary key field
}
}
