<?php

namespace Codilar1\BuyOne\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_TEXTAREA_FIELD = 'codilar1_buyone/general/textarea_field';

    public function getTextareaFieldValue()
    {
        $value = $this->scopeConfig->getValue(self:: XML_PATH_TEXTAREA_FIELD , ScopeInterface::SCOPE_STORE);
        $skuArray = $value ? array_map('trim', explode(',', $value)) : [];
        return !empty($skuArray) ? $skuArray[array_rand($skuArray)] : '';

    }
}
