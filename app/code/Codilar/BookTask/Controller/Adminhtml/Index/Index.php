<?php

namespace Codilar\BookTask\Controller\Adminhtml\Index;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Test_HelloWorld::helloworld';

    protected $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Test')));
        return $resultPage;
    }


}
