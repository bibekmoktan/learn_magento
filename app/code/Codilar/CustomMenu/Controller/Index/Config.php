<?php

namespace Codilar\CustomMenu\Controller\Index;
use Magento\Framework\View\Result\PageFactory;

class Config extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $helperData;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
         PageFactory $pageFactory,
        \Codilar\CustomMenu\Helper\Data $helperData
    )
    {
        $this->helperData = $helperData;
        $this->_pageFactory = $pageFactory;

        return parent::__construct($context);
    }
    public function execute()
    {
        echo $this->helperData->getGeneralConfig('enable');
        echo $this->helperData->getGeneralConfig('display_text');
        exit();
    }
}
