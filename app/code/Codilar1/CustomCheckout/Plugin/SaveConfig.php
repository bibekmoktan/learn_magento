<?php
namespace Codilar1\CustomCheckout\Plugin;

use Magento\Checkout\Model\DefaultConfigProvider;
use Magento\Framework\App\Config\ScopeConfigInterface;

class SaveConfig
{
const XML_PATH_CUSTOM_TAX_RATE = 'custom_tax_section/custom_tax_group/rate';

protected $scopeConfig;

public function __construct(ScopeConfigInterface $scopeConfig)
{
$this->scopeConfig = $scopeConfig;
}

public function afterGetConfig(DefaultConfigProvider $subject, array $result)
{
$customTaxRate = $this->scopeConfig->getValue(self::XML_PATH_CUSTOM_TAX_RATE, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
$result['customTaxRate'] = $customTaxRate;
return $result;
}
}
