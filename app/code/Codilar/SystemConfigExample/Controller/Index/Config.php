<?php

namespace Codilar\SystemConfigExample\Controller\Index;
use Magento\Framework\View\Result\PageFactory;

class Config extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $helperData;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,


        PageFactory $pageFactory,

    )
    {
        $this->_pageFactory = $pageFactory;

        return parent::__construct($context);
    }
    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
