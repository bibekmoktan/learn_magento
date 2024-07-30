<?php

namespace Codilar1\SalesReports\Controller\Adminhtml\Index;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\File\Csv;
use Magento\Framework\Filesystem;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\View\Result\LayoutFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Controller\ResultFactory;

class SalesReport extends Action
{
    public const REPORT_ONE = 1;

    protected $_messageManager;
    protected $scopeConfig;
    protected $resultPageFactory = false;
    protected $fileFactory;
    protected $resultLayoutFactory;
    protected $csvProcessor;
    protected $directoryList;
    protected $resource;
    private $directory;
    private $storeManager;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ResourceConnection $resourceConnection,
        FileFactory $fileFactory,
        LayoutFactory $resultLayoutFactory,
        Csv $csvProcessor,
        DirectoryList $directoryList,
        ScopeConfigInterface $scopeConfig,
        Filesystem $filesystem,
        StoreManagerInterface $storeManager,
        ManagerInterface $messageManager
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->fileFactory = $fileFactory;
        $this->resultLayoutFactory = $resultLayoutFactory;
        $this->csvProcessor = $csvProcessor;
        $this->directoryList = $directoryList;
        $this->scopeConfig = $scopeConfig;
        $this->resource = $resourceConnection;
        $this->storeManager = $storeManager;
        $this->directory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
        $this->_messageManager = $messageManager;
    }

    public function execute()
    {
        try {
            $toDate = $this->getRequest()->getParam('to_date');
            $fromDate = $this->getRequest()->getParam('from_date');
            $reportType = $this->getRequest()->getParam('report_type');

            if ($reportType == self::REPORT_ONE) {
                $this->resultLayoutFactory->create();

                $filepath = 'export/sales_report.csv';
                $this->directory->create('export');
                $stream = $this->directory->openFile($filepath, 'w+');
                $stream->lock();


                $header = ['Order Count', 'Subtotal Sum', 'Grand Total Sum'];
                $stream->writeCsv($header);

                $guestData = $this->getGuestData($fromDate, $toDate);

                foreach ($guestData as $guestOrder) {
                    $data = [];
                    $data[] = $guestOrder['order_count'];
                    $data[] = $guestOrder['subtotal_sum'];
                    $data[] = $guestOrder['grandtotal_sum'];

                    $stream->writeCsv($data);
                }


                $header = ['Order Count', 'Subtotal Sum', 'Grand Total Sum'];
                $stream->writeCsv($header);

                $logged = $this->getLoggedInData($fromDate, $toDate);
                foreach ($logged as $loggedIn) {
                    $data = [];
                    $data[] = $loggedIn['order_count'];
                    $data[] = $loggedIn['subtotal_sum'];
                    $data[] = $loggedIn['grandtotal_sum'];

                    $stream->writeCsv($data);
                }

                $downloadedFileName = 'SalesReport_' . date('Ymd_His') . '.csv';
                $content['type'] = 'filename';
                $content['value'] = $filepath;
                $content['rm'] = true; // remove CSV file after download

                return $this->fileFactory->create($downloadedFileName, $content, DirectoryList::VAR_DIR);
            }
        } catch (Exception $e) {
            $this->_messageManager->addErrorMessage(__('There was an error while generating the report: %1', $e->getMessage()));
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }

    /**
     * @param string $from
     * @param string $to
     * @return array
     */
    public function getGuestData($from , $to){

        $select = " SELECT
        COUNT(*) AS order_count,
        SUM(subtotal) AS subtotal_sum,
        SUM(grand_total) AS grandtotal_sum
      FROM sales_order
      WHERE customer_id IS NULL
      AND created_at >= CONVERT_TZ('{$from} 00:00:00', '+00:00', '-4:00')
     AND created_at <= CONVERT_TZ('{$to} 23:59:59', '+00:00', '-4:00')";
         
         return $this->resource->getConnection()->fetchAll($select);
     }
     public function getLoggedInData($from, $to) {
 
         $select = "SELECT
             COUNT(*) AS order_count,
             SUM(subtotal) AS subtotal_sum,
             SUM(grand_total) AS grandtotal_sum
           FROM sales_order
           WHERE customer_id IS NOT NULL
 
             AND created_at >= CONVERT_TZ('{$from} 00:00:00', '+00:00', '-4:00')
             AND created_at <= CONVERT_TZ('{$to} 23:59:59', '+00:00', '-4:00')";
     
         return $this->resource->getConnection()->fetchAll($select);
     }
}
