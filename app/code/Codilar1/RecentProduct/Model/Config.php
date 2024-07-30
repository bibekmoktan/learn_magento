<?php

namespace Codilar1\RecentProduct\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config extends \Magento\Framework\App\Config
{
    const XML_PATH_PRODUCTLIST_DAYS = 'new_products/general/days';

    /**
     * Get the number of days to filter products
     *
     * @param int $storeId
     * @return int
     */
    public function getDays($storeId = null)
    {
        return (int)$this->getValue(self::XML_PATH_PRODUCTLIST_DAYS, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
    }
}
