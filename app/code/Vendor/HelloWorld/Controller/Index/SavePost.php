<?php
namespace Vendor\HelloWorld\Controller\Index;


use Magento\Framework\App\Action\Action;
use Vendor\HelloWorld\Model\ResourceModel\DataFactory as ResourceModel;
use Vendor\HelloWorld\Model\DataFactory;

class SavePost extends Action
{
    protected $resultPageFactory = false;

    protected $resourcModel;
    protected $dataModel;

    public function __construct(
        \Magento\Framework\App\Action\Context      $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        ResourceModel                                      $model,
        DataFactory $dataFactory

    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->resourcModel = $model;
        $this->dataModel =$dataFactory;
    }
    public function execute()
    {
        $params = $this->getRequest()->getParams();
        try {
        $model = $this->dataModel->create();
        $resourceModel = $this->resourcModel->create();
        $resourceModel->load($model, $params); // for load
        $resourceModel->save($model); // for save
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Something went wrong."));
        }
        /* Redirect back to hero display page */
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('helloworld/index/book');
        return $redirect;
    }
}

