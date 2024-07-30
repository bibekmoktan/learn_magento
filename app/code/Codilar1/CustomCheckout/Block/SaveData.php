<?php
namespace Codilar1\CustomCheckout\Block;

use Magento\Framework\View\Element\Template;
use Magento\Checkout\Model\Session as CheckoutSession;

class SaveData extends Template
{
protected $checkoutSession;

public function __construct(
Template\Context $context,
CheckoutSession $checkoutSession,
array $data = []
) {
$this->checkoutSession = $checkoutSession;
parent::__construct($context, $data);
}

public function getCustomTaxAmount()
{
$quote = $this->checkoutSession->getQuote();
return $quote->getCustomTaxAmount();
}

public function getSessionData($key)
{
return $this->checkoutSession->getData($key);
}

public function getQuoteItems()
{
$quote = $this->checkoutSession->getQuote();
$items = $quote->getAllItems();
$quoteItems = [];

foreach ($items as $item) {
$quoteItems[] = [
'item_id' => $item->getItemId(),
'product_id' => $item->getProductId(),
'name' => $item->getName(),
'qty' => $item->getQty(),
'price' => $item->getPrice(),
'custom_tax_amount' => $item->getCustomTaxAmount('custom_tax_amount')
];
}

return $quoteItems;
}
}
