<?php
namespace Codilar\CustomerGrid\Model\ResourceModel\Grid;

use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $storeManager;

    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        StoreManagerInterface $storeManager,
        AdapterInterface $connection = null,
        AbstractDb $resource = null
    )
    {
        $this->storeManager = $storeManager;
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
    }

    protected function _initSelect()
    {
        parent::_initSelect();

        $column = 'entity_id';

        $this->getSelect()
            ->joinLeft(
                ['customer_entity' => $this->getTable('customer_entity')],
                'main_table.' . $column . ' = customer_entity.' . $column,
                ['phone_number', 'email']
            )
            ->where(
                'customer_entity.' . $column . ' IN (
                    SELECT c1.' . $column . '
                    FROM customer_entity c1
                    JOIN customer_entity c2
                    ON c1.phone_number = c2.phone_number
                    AND c1.email <> c2.email
                )'
            );
        $this->getSelect()->joinLeft(
            ['secondTable' => $this->getTable('magento_customerbalance')],
            'main_table.entity_id = secondTable.customer_id',
            ['*'] // '*' defines that you want all columns of the second table. If you want some particular columns, define them here.
        );
        $this->getSelect()->joinLeft(
            ['orders' => $this->getTable('sales_order')],
            'main_table.entity_id = orders.customer_id',
            ['order_count' => 'COUNT(orders.entity_id)']
        )->group('main_table.entity_id');
    }

    protected function _construct()
    {
        $this->_init('Codilar\CustomerGrid\Model\Customer', 'Codilar\CustomerGrid\Model\ResourceModel\Customer');
    }
}

