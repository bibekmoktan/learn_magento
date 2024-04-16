<?php

namespace Vendor\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

use Magento\Framework\View\Result\PageFactory;
use Vendor\HelloWorld\Model\DataFactory;
use Vendor\HelloWorld\Api\DataRepositoryInterface;
use Vendor\HelloWorld\Api\Data\DataInterface;

class Index extends Action
{
    protected $_pageFactory;
    protected $_dataFactory;
    protected $_dataModel;
    public function __construct(
         Context $context,
         PageFactory $pageFactory,
          DataFactory $dataFactory,
         DataRepositoryInterface $dataRepository,
         DataInterface $dataInterface
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_dataFactory = $dataFactory;
        $this->_dataRepository=$dataRepository;
        $this->_dataModel = $dataInterface;

        return parent :: __construct($context);

    }
    public function execute()
    {
//      $collection  = $this->_dataFactory->create();
//      $data = $collection->getCollection();
//      echo '<pre>'; print_r($data->getData());

        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Test')));
        return $resultPage;
/// Select
//        $data = $this->_dataRepository->getById(1);
//         echo '<pre>';print_r($data->getData());

//        $data = $this->_dataRepository->getById(2);
//        echo '<pre>';print_r($data->getData());
//

        /* Insert data
        $this->_dataModel->setStudentName("test");
         $this->_dataModel->setStudentRollNo("111111");
         $this->_dataModel->setStudentStatus(1);
         try{
             $this->_dataRepository->save($this->_dataModel);
             echo 'Record Inserted';
         }catch(\Exception $e){
             die($e->getMessage());
         }
         $this->_dataRepository->save($this->_dataModel);
           */
         /* Update data*/
//         $data = $this->_dataRepository->getById(2);
//         $data->setStudentName(' arika ');
//         try{
//             $this->_dataRepository->save($data);
//             echo 'Record Updated';
//         }catch(\Exception $e){
//             die($e->getMessage());
//         }
         /* Delete */
//         $this->_dataRepository->deleteById(1);

        die('end here');
    }
}
