<?php
namespace Codilar\HelloWorld\Controller\Index;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Index extends Action
{
    protected $pageFactory;

        public function __construct(\Magento\Framework\View\Result\PageFactory $pageFactory,
        Context $context)
        {
            $this->pageFactory =$pageFactory;

            parent :: __construct($context);
        }

        public function execute()
        {
            return $this->pageFactory->create();
        }
}
?>
