<?php
namespace Codilar1\BuyOne\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Codilar1\BuyOne\Helper\Data as BuyOneHelper;
use Magento\Checkout\Model\Cart;
use Psr\Log\LoggerInterface;

class RemoveFreeProductObserver implements ObserverInterface
{
    protected $buyOneHelper;
    protected $cart;
    protected $logger;

    public function __construct(
        BuyOneHelper $buyOneHelper,
        Cart $cart,
        LoggerInterface $logger
    ) {
        $this->buyOneHelper = $buyOneHelper;
        $this->cart = $cart;
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        try {
            $additionalProductSku = $this->buyOneHelper->getTextareaFieldValue();
            $quote = $this->cart->getQuote();

            foreach ($quote->getAllItems() as $quoteItem) {
                if ($quoteItem->getSku() === $additionalProductSku) {
                    $this->cart->removeItem($quoteItem->getItemId());
                }
            }
        } catch (\Exception $e) {
            $this->logger->error('Error in RemoveFreeProductQuantity Observer: ' . $e->getMessage());
        }
        return $this;
    }
}
