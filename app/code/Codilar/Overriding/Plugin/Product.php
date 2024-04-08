<?php
namespace Codilar\Overriding\Plugin;
class Product
{
    public function beforeAddProduct(\Magento\Quote\Model\Quote $subject, $productInfo, $requestInfo = null)
    {
        $requestInfo['qty'] = 2;

        return [$productInfo, $requestInfo];
    }
}
