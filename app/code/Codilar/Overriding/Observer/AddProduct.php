<?php
namespace Codilar\Overriding\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
class AddProduct implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $collection = $observer->getEvent()->getData('collection');
        foreach ($collection as $product)
        {
            $price=$product->getData('price');

            $name=$product->getData('name');

            if ($price < 50)
            {
                $price = 50;           }
            else
            {
                 $price = 100;
            }
            $product->setPrice($price);
        }
    }
}
