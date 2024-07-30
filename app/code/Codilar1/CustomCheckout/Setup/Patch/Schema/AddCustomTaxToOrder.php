<?php
namespace Codilar1\CustomCheckout\Setup\Patch\Schema;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class AddCustomTaxToOrder implements SchemaPatchInterface
{
    private $schemaSetup;

    public function __construct(SchemaSetupInterface $schemaSetup)
    {
        $this->schemaSetup = $schemaSetup;
    }

    public function apply()
    {
        $installer = $this->schemaSetup;

        $installer->startSetup();

        $tables = [
            $installer->getTable('sales_order'),
            $installer->getTable('sales_invoice'),
            $installer->getTable('sales_creditmemo'),
            $installer->getTable('quote')
        ];

        foreach ($tables as $table) {
            if (!$installer->getConnection()->isTableExists($table)) {
                continue;
            }
            $connection = $installer->getConnection();
            $connection->addColumn(
                $table,
                'custom_tax_amount',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'length' => '12,4',
                    'nullable' => true,
                    'comment' => 'Custom Tax Amount'
                ]
            );
            $connection->changeColumn(
                $table,
                'base_custom_tax_amount', // Replace with your actual column name
                'custom_tax_rate',
                [
                    'type' => Table::TYPE_INTEGER,
                    'nullable' => true,
                    'comment' => 'Base Custom Tax Amount'
                ]
            );
        }

        $installer->endSetup();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
