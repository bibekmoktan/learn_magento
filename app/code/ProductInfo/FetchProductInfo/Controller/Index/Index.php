<?php
    namespace ProductInfo\FetchProductInfo\Controller\Index;

    use Magento\Backend\App\Action\Context;
    use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
    {
        protected $pageFactory;
        protected $productCollectionFactory;

        public function __construct(\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
            PageFactory $pageFactory,
            Context $context
        )
        {
            $this->productCollectionFactory =$collectionFactory;
            $this->pageFactory= $pageFactory;
            parent ::__construct($context);
        }
     public function execute()
     {
         return $this->pageFactory->create();
     }
    }
?>
