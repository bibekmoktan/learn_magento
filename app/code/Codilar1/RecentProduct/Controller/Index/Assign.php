<?php
namespace Codilar1\RecentProduct\Controller\Index;

use Magento\Framework\View\Result\PageFactory;
use Magento\Catalog\Api\CategoryLinkManagementInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Codilar1\RecentProduct\Model\Config;

class Assign extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var CollectionFactory
     */
    protected $_productCollectionFactory;

    /**
     * @var CategoryLinkManagementInterface
     */
    protected $categoryLinkManagement;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context $context
     * @param PageFactory $rawFactory
     * @param CategoryLinkManagementInterface $categoryLinkManagement
     * @param CollectionFactory $productCollectionFactory
     * @param Config $config
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        PageFactory $rawFactory,
        CategoryLinkManagementInterface $categoryLinkManagement,
        CollectionFactory $productCollectionFactory,
        Config $config
    ) {
        $this->categoryLinkManagement = $categoryLinkManagement;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->pageFactory = $rawFactory;
        $this->config = $config;

        parent::__construct($context);
    }

    public function getProductCollection()
    {
        $days = $this->config->getDays();
        $date = new \DateTime();
        $date->modify("-$days days");
        $fromDate = $date->format('Y-m-d H:i:s');

        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter('created_at', ['gteq' => $fromDate]);
        $collection->setOrder('created_at', 'DESC');

        return $collection;
    }

    public function execute()
    {
        $data =$this->getProductCollection();

        echo $data->getSize();

        $categoryId = 5883;

        foreach($data as $item){
            echo "<pre>";
            print_r($item->getData());
            $this->categoryLinkManagement->assignProductToCategories(
                $item->getSku(),
                array_merge([$categoryId], $item->getCategoryIds())
            );
        }
        echo "Hello";   
    }
}
