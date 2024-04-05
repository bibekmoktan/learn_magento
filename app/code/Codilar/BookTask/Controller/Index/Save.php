<?php

namespace Codilar\BookTask\Controller\Index;

use Codilar\BookTask\Model\DataFactory;
use Codilar\BookTask\Model\ResourceModel\Data as personResourceModel;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Codilar\BookTask\Model\Data ;

class Save extends Action
{

    protected $data;
    protected $_dataModel;

    protected $personResourceModel;


    public function __construct(
        Context $context,
        DataFactory $data,
        personResourceModel $personResourceModel,
        Data $dataModel
    ) {
        $this->data = $data;
        $this->personResourceModel = $personResourceModel;
        $this->_dataModel = $dataModel;
        parent::__construct($context);
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $id =$this->getRequest()->getParam('id');
        try {
            if(isset($id)){
                    $model = $this->data->create()->load($id);
                    $model->addData($params);
                    $model->save();
                    $this->messageManager->addSuccessMessage(__("Successfully Updated"));
            }
            else
            {
                $hero = $this->_dataModel->setData($params);
                $this->personResourceModel->save($hero);
                $this->messageManager->addSuccessMessage(__("Successfully added the"). $params['name']);
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Something went wrong."));
        }
        /* Redirect back to display page */
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('*/*/');
        return $redirect;
    }
}
