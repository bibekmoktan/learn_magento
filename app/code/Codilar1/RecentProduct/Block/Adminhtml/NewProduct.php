<?php

namespace Codilar1\RecentProduct\Block\Adminhtml;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Codilar1\RecentProduct\Model\Config;
use DateTime;

class NewProduct extends Template
{
    protected $_productCollectionFactory;
    protected $config;
  
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,        
        Config $config,

    )
    {    
        $this->_productCollectionFactory = $productCollectionFactory;    
        $this->config = $config;
        parent::__construct($context);
    }



    public function getProductCollection()
{
    $days = $this->config->getDays();
    $date = new \DateTime();
    $date->modify("-$days days");
    $fromDate = $date->format('Y-m-d H:i:s');

    $collection = $this->_productCollectionFactory->create();
    $collection->addAttributeToSelect('*');
    $collection->addAttributeToFilter('created_at', ['gteq' => $fromDate]);
    $collection->setOrder('created_at', 'DESC');

    return $collection;;
}
}
