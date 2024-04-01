<?php

namespace DemoExt\ExtAttribute\Plugin;

use Magento\Catalog\Api\ProductRepositoryInterface;

class Product
{
    public function afterGet
    (
        ProductRepositoryInterface $subject, $entity
    )
    {
       $extension = $entity->getExtensionAttributes();
       $extension->setIsFeatured("this is my custom data");
       $entity->setExtensionAttributes($extension);

       return $entity;
    }
}
