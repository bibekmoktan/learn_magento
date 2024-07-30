<?php
namespace Codilar\CustomerGrid\Ui\DataProvider\Customer\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

/**
 * Class Collection
 * @package Codilar\CustomerGrid\Ui\DataProvider\Customer\Listing
 */
class Collection extends SearchResult
{
    /**
     * Override _initSelect to add custom columns
     *
     * @return void
     */
    protected function _initSelect()
    {
        $this->addFilterToMap('entity_id', 'main_table.entity_id');
        $this->addFilterToMap('email', 'customer_entity.email');
        $this->addFilterToMap('phone_number', 'customer_entity.phone_number');
        parent::_initSelect();
    }
}
