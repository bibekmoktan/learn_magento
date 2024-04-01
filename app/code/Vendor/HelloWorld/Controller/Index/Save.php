<?php

namespace Vendor\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Vendor\HelloWorld\Model\Data;
use Vendor\HelloWorld\Model\ResourceModel\Data as Model;

class Save extends Action
{
    protected $_pageFactory;

    protected $data;
    protected $resourceData;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        Data $_data,
        Model $_resourceData

    )
    {
        $this->_pageFactory = $pageFactory;
        $this->data =$_data;
        $this->resourceData =$_resourceData;
        return parent::__construct($context);
    }

    public function execute()
    {

        return $this->_pageFactory->create();
    }
}

