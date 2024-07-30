<?php

namespace Codilar1\BuyOne\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Checkout\Model\Cart;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Codilar1\BuyOne\Helper\Data as BuyOneHelper;
use Psr\Log\LoggerInterface;

class AddProduct implements ObserverInterface
{
    protected $cart;
    protected $productRepository;
    protected $buyOneHelper;
    protected $logger;

    public function __construct(
        Cart $cart,
        ProductRepositoryInterface $productRepository,
        BuyOneHelper $buyOneHelper,
        LoggerInterface $logger
    ) {
        $this->cart = $cart;
        $this->productRepository = $productRepository;
        $this->buyOneHelper = $buyOneHelper;
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        try {
            // Get the quote and the added product
            $quoteItem = $observer->getEvent()->getQuoteItem();
            $quote = $quoteItem->getQuote();
            $quoteItemQty = $quoteItem->getQty(); // Get the quantity of the added product

            // Get the additional product SKU from configuration
            $additionalProductSku = $this->buyOneHelper->getTextareaFieldValue();

            // Load the additional product by SKU
            $additionalProduct = $this->productRepository->get($additionalProductSku);

            // Add the additional product to the quote with the same quantity
            $additionalQuoteItem = $quote->addProduct($additionalProduct, $quoteItemQty);

            // Set custom price for the additional product
            if ($additionalQuoteItem) {
                $additionalQuoteItem->setCustomPrice(0);
                $additionalQuoteItem->setOriginalCustomPrice(0);
                $additionalQuoteItem->getProduct()->setIsSuperMode(true);
            }
            // Save the cart
            $this->cart->save();

            // Log information for debugging
            $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/test.log');
            $logger = new \Zend_Log();
            $logger->addWriter($writer);
            $logger->info('Order Information: ' . print_r($quoteItem->debug(), true));

        } catch (\Exception $e) {
            $this->logger->error('Error adding additional product to cart: ' . $e->getMessage());
        }
    }
}
