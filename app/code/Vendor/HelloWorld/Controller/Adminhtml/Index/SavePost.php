<?php

namespace Vendor\HelloWorld\Controller\Adminhtml\Index;

class SavePost extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;
    protected $postFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context        $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Vendor\HelloWorld\Model\DataFactory         $dataFactory
    )
    {
        $this->postFactory = $dataFactory;
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('book_id');
        try {
            if (isset($id) && !empty($id)) {
                $model = $this->postFactory->create()->load($id);
                $model->addData($data);
                $model->save();
            } else {
                $model = $this->postFactory->create();
                $model->setData($data);
                $model->save();
            }
            $this->messageManager->addSuccessMessage(__('You saved the post.'));
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the post.'));
        }
        return $resultRedirect->setPath('*/*/');
    }


}
