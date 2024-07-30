<?php

namespace Codilar1\SalesReports\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;


class Reports extends Template
{
    
    /**
     * @var ResourceConnection
     */
    private $resource;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param Context $context
     * @param ResourceConnection $resourceConnection
     * @param StoreManagerInterface $storeManager
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        Context              $context,
        ResourceConnection   $resourceConnection,
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->resource = $resourceConnection;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    /**
     * @return mixed
     */
    public function getToData()
    {
        return $this->getTo();
    }

    /**
     * @return mixed
     */
    public function getFromData()
    {
        return $this->getFrom();
    }

    /**
     * @return mixed
     */
    public function getReportTypeData()
    {
        return $this->getReportType();
    }
    /**
     * @return string
     */
    public function getReportUrl()
    {
        return $this->getUrl('reports/index/salesdata');
    }

    /**
     * @return string
     */
    public function getReportDownloadUrl()
    {
        return $this->getUrl('reports/index/salesreport');
    }

  

    public function getGuestData($to , $from){

       $select = " SELECT
       COUNT(*) AS order_count,
       SUM(subtotal) AS subtotal_sum,
       SUM(grand_total) AS grandtotal_sum
     FROM sales_order
     WHERE customer_id IS NULL
     AND created_at >= CONVERT_TZ('{$from} 00:00:00', '+00:00', '-4:00')
    AND created_at <= CONVERT_TZ('{$to} 23:59:59', '+00:00', '-4:00')";
        
        return $this->resource->getConnection()->fetchAll($select);
    }
    public function getLoggedInData($to, $from) {

        $select = "SELECT
            COUNT(*) AS order_count,
            SUM(subtotal) AS subtotal_sum,
            SUM(grand_total) AS grandtotal_sum
          FROM sales_order
          WHERE customer_id IS NOT NULL

            AND created_at >= CONVERT_TZ('{$from} 00:00:00', '+00:00', '-4:00')
            AND created_at <= CONVERT_TZ('{$to} 23:59:59', '+00:00', '-4:00')";
    
        return $this->resource->getConnection()->fetchAll($select);
    }
    
}
