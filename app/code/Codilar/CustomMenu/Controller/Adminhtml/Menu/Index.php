<?php
namespace Codilar\CustomMenu\Controller\Adminhtml\Menu;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class CustomMenu extends Action
{

    const ADMIN_RESOURCE = 'Codilar_CustomMenu::test';
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
