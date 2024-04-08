<?php
namespace Codilar\Overriding\Plugin;
class ProductName
{
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        return $result."Product Name Changed";
    }
}
