<?php

namespace Codilar\BookTask\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Codilar\BookTask\Model\ResourceModel\Data\CollectionFactory;
use Codilar\BookTask\Model\DataFactory;

class MassDelete extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;
    protected $postFactory;

    public $collectionFactory;

    public $filter;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        Filter $filter,
        CollectionFactory $collectionFactory,
        DataFactory $postFactory
    )
    {
        parent::__construct($context);
        $this->postFactory = $postFactory;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {   $ids=$this->getRequest()->getParams();
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $count = 0;

            foreach ($ids['selected'] as $id) {
                $model = $this->postFactory->create()->load($id);
                $model->delete();
                $count++;
            }

            $this->messageManager->addSuccess(__('A total of %1 item have been deleted.', $count));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }


}
