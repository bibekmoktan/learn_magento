<?php

namespace Test\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

use Magento\Framework\View\Result\PageFactory;
use Vendor\HelloWorld\Model\DataFactory;

class Index extends Action
{
    protected $_pageFactory;
    protected $_dataFactory;
    protected $_dataModel;
    public function __construct(
         Context $context,
         PageFactory $pageFactory,
          DataFactory $dataFactory,
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_dataFactory = $dataFactory;
        return parent :: __construct($context);
    }
    public function execute()
    {
      $collection  = $this->_dataFactory->create();
      $data = $collection->getCollection();
      echo '<pre>'; print_r($data->getData());
        return $this->_pageFactory->create();

    }
}
