<?php
namespace Codilar\Overriding\Model;
class Product extends \Magento\Catalog\Model\Product
{
   public function getName()
   {
       return 'test';
   }
}
