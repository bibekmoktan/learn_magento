<?php

namespace Vendor\HelloWorld\Controller\Adminhtml\Index;

class DeletePost extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;
    protected $postFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Vendor\HelloWorld\Model\DataFactory $postFactory
    )
    {
        $this->postFactory = $postFactory;
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {

        $resultRedirect = $this->resultRedirectFactory->create();
        $id=$this->getRequest()->getParam('book_id');
        try{
            $model = $this->postFactory->create()->load($id);
            $model->delete();
            $this->messageManager->addSuccessMessage(__('You have deleted the post.'));
        }catch(\Exception $e){
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the post.'));
        }
        return $resultRedirect->setPath('*/*/');
    }


}
