<?php

namespace Codilar\TaskAttribute\Plugin;

use Magento\Catalog\Api\ProductRepositoryInterface;

class Product
{
    public function afterGet
    (
        ProductRepositoryInterface $subject,
        $product
    ) {
        $extensionAttributes = $product->getExtensionAttributes();
        $extensionAttributes->setIsNew('this is custom featured');
        $product->setExtensionAttributes($extensionAttributes);

        return $product;
    }
}
