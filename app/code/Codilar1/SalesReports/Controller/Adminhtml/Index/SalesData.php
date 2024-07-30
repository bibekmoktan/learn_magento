<?php

namespace Codilar1\SalesReports\Controller\Adminhtml\Index;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Api\WebsiteRepositoryInterface;

class SalesData  extends Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $jsonResultFactory;

    protected $resultPageFactory = false;
    private $websiteRepository;
    private $resourceConnection;

    public function __construct(
        Context                                          $context,
        PageFactory                                      $resultPageFactory,
        ResourceConnection                               $resourceConnection,
        \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory,
        WebsiteRepositoryInterface                       $websiteRepository
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->resourceConnection = $resourceConnection;
        $this->jsonResultFactory = $jsonResultFactory;
        $this->websiteRepository = $websiteRepository;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function execute()
    {
        try {
            $toDate = $this->getRequest()->getParam('to_date');
            $fromDate = $this->getRequest()->getParam('from_date');
            $reportType = $this->getRequest()->getParam('report_type');
            
            $result = $this->jsonResultFactory->create();
            $resultPage = $this->resultPageFactory->create();

            $block = $resultPage->getLayout()
                ->createBlock('Codilar1\SalesReports\Block\Adminhtml\Reports')
                ->setTemplate('Codilar1_SalesReports::sales_reports_data.phtml')
                ->setData('to', $toDate)
                ->setData('from', $fromDate)
                ->setData('report_type', $reportType)
                ->toHtml();

            $result->setData(['output' => $block]);
            return $result;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
