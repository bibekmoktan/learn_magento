<?php

namespace Vendor\HelloWorld\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Vendor\HelloWorld\Model\ResourceModel\Data\Collection as viewCollection;
use \Vendor\HelloWorld\Model\ResourceModel\Data\CollectionFactory as ViewCollectionFactory;

class Book extends Template
{

    protected $_viewCollectionFactory = null;


    public function __construct(
        Context               $context,
        ViewCollectionFactory $viewCollectionFactory,
        array                 $data = []
    )
    {
        $this->_viewCollectionFactory = $viewCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getCollection()
    {

        $viewCollection = $this->_viewCollectionFactory->create();
        $viewCollection->addFieldToSelect('*')->load();
        return $viewCollection->getItems();
    }

    public function getPostUrl(){

        return $this->getUrl('helloworld/index/savepost');
    }
}

