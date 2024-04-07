<?php

namespace Codilar\BookTask\Controller\Adminhtml\Index;

class DeleteBook extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;
    protected $dataFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Codilar\BookTask\Model\DataFactory $dataFactory
    )
    {
        $this->dataFactory = $dataFactory;
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id=$this->getRequest()->getParam('id');
        // echo $id; exit;
        try{
            $model = $this->dataFactory->create()->load($id);
            $model->delete();
            $this->messageManager->addSuccessMessage(__('You have deleted the post.'));
        }catch(\Exception $e){
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the post.'));
        }
        return $resultRedirect->setPath('*/*/');
    }


}
