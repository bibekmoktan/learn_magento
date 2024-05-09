<?php

namespace Codilar\BookTask\Controller\Adminhtml\Index;

class SaveBook extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
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
        $data = $this->getRequest()->getPostValue();
        $id = $this->getRequest()->getParam('id');
        try{
            if(isset($id) && !empty($id)){
                $model = $this->dataFactory->create()->load($id);
                $model->addData($data);
                $model->save();
            }
                $model =$this->dataFactory->create();
                $model->setData($data);
                $model->save();
            $this->messageManager->addSuccessMessage(__('You saved the post.'));
        }catch(\Exception $e){
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the post.'));
        }
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }

}
