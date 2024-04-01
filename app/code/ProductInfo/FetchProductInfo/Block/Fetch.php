<?php
    namespace ProductInfo\FetchProductInfo\Block;
    use Magento\Framework\View\Element\Template\Context;

    class Fetch extends \Magento\Framework\View\Element\Template
    {

        protected $collectionFactory;
        public function __construct(
            Context $context,
            \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collection,
            array $data = []
        ) {
            $this->collectionFactory = $collection;
            parent::__construct( $context,$data);
        }
        public function getProductinfo()
        {
            $collection = $this->collectionFactory->create()->addAttributeToSelect('name');
            $collection->setPageSize(3);
         foreach ($collection as $product)
         {
             echo "<pre>";
             print_r($product->getData());
         }
        }
    }
?>
