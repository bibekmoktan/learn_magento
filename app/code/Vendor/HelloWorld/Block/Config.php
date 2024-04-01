<?php
namespace Vendor\HelloWorld\Block;


use Magento\Store\Model\ScopeInterface;
use Vendor\HelloWorld\Helper\Data;


class Config extends \Magento\Framework\View\Element\Template
{
    protected $helperData;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        Data $helperData
    )

{
    $this->helperData = $helperData;
        parent::__construct($context);
    }
public function getValue()
{
    return $this->helperData->getGeneralConfig('enable');
}
public function getMessage()
{
    return $this->helperData->getGeneralConfig('display_text');
}
}
