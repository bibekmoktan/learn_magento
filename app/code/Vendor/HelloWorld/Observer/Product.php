<?php
namespace Vendor\HelloWorld\Observer;


use Magento\Directory\Model\Observer;
use Magento\Framework\Event\ObserverInterface;

class Product implements ObserverInterface
{
        public function execute(Observer|\Magento\Framework\Event\Observer $observer)
        {
            $collection = $observer->getEvent()->getData('collection');

            foreach ($collection as $product ){

                $price = $product->getData('price');
                $name = $product->getData('name');

                if($price< 20){
                    $name .= " it is cheap ";
                }
                else
                {
                    $name .= " It is expensive";
                }
                return $product->setData('name',$name);
            }
        }
}
?>

