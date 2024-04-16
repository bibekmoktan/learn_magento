<?php

namespace Vendor\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

use Magento\Framework\View\Result\PageFactory;
use Vendor\HelloWorld\Model\DataFactory;
use Vendor\HelloWorld\Api\DataRepositoryInterface;
use Vendor\HelloWorld\Api\Data\DataInterface;

class Book extends Action
{
    protected $_pageFactory;
    protected $_dataFactory;
    protected $_dataModel;
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        DataFactory $dataFactory,
        DataRepositoryInterface $dataRepository,
        DataInterface $dataInterface
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_dataFactory = $dataFactory;
        $this->_dataRepository=$dataRepository;
        $this->_dataModel = $dataInterface;

        return parent :: __construct($context);
    }
    public function execute()
    {
//        $data = $this->_dataRepository->getById(1);
//        echo '<pre>';print_r($data->getData());
        return $this->_pageFactory->create();
    }
}
