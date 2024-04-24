<?php

namespace Codilar\BookTask\Controller\Adminhtml\Index;
use Magento\Backend\App\Action;
use Codilar\BookTask\Api\BookRepositoryInterface;
use Codilar\BookTask\Api\Book\BookInterface;
use Magento\Framework\Exception\NoSuchEntityException;


class SaveBook extends Action
{
    protected $resultPageFactory;
    protected $dataFactory;
    protected $bookRepository;
    protected $bookFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        BookRepositoryInterface $bookRepository,
        \Codilar\BookTask\Api\Book\BookInterfaceFactory $bookFactory,
        \Codilar\BookTask\Api\Book\BookInterface $dataFactory
    )
    {
        $this->bookFactory = $bookFactory;
        $this->bookRepository = $bookRepository;
        $this->dataFactory = $dataFactory;
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $data = $this->getRequest()->getPostValue();
        $id = $this->getRequest()->getParam('id');
        try{
            if(isset($id) && !empty($id)){
                $model =$this->bookFactory->create()->load($id);
                $model->addData($data);
                $model->save();
                return $resultRedirect->setPath('*/*/');
            }
            $this->dataFactory->setIsbn($data['isbn']);
            $this->dataFactory->setTitle($data['title']);
            $this->dataFactory->setAuthorName($data['author_name']);
            $this->dataFactory->setCategory($data['category']);
            $this->dataFactory->setPrice($data['price']);
            $this->bookRepository->save($this->dataFactory);

            $this->messageManager->addSuccessMessage(__('You saved the post.'));
        }catch(\Exception $e){
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the post.'));
        }
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }

}
