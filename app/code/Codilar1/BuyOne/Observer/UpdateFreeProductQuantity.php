<?php
namespace Codilar1\BuyOne\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Codilar1\BuyOne\Helper\Data as BuyOneHelper;
use Magento\Checkout\Model\Cart;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ProductFactory;
use Psr\Log\LoggerInterface;
use function Psy\debug;

class UpdateFreeProductQuantity implements ObserverInterface
{
    protected $buyOneHelper;
    protected $productRepository;
    protected $cart;
    protected $productFactory;
    protected $logger;

    public function __construct(
        BuyOneHelper $buyOneHelper,
        ProductRepositoryInterface $productRepository,
        Cart $cart,
        ProductFactory $productFactory,
        LoggerInterface $logger
    ) {
        $this->buyOneHelper = $buyOneHelper;
        $this->productRepository = $productRepository;
        $this->cart = $cart;
        $this->productFactory = $productFactory;
        $this->logger = $logger;
    }
    public function execute(Observer $observer)
    {
        try {
            $additionalProductSku = $this->buyOneHelper->getTextareaFieldValue();
            $quote = $this->cart->getQuote();

            foreach ($quote->getAllItems() as $quoteItem) {
                if ($quoteItem->getSku() !== $additionalProductSku) {
                    $mainProductQty = $quoteItem->getQty();
                    $this->log('Main Product Quantity: ' . $mainProductQty);
                    break; // Assuming there is only one main product per quote
                }
            }
            foreach ($quote->getAllItems() as $quoteItem) {
                if ($quoteItem->getSku() === $additionalProductSku) {
                    $quoteItem->setQty($mainProductQty);
                    $quoteItem->setCustomPrice(0);
                    $quoteItem->setOriginalCustomPrice(0);
                    $quoteItem->getProduct()->setIsSuperMode(true);
                }
            }
            // Save the cart after updating the quantities
            $this->cart->save();
        } catch (\Exception $e) {
            $this->logger->error('Error in UpdateFreeProductQuantity Observer: ' . $e->getMessage());
        }
        return $this;
    }
    private function log($message)
    {
        $writer = new \Zend_Log_Writer_Stream(BP .'/var/log/test.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info($message);
    }
}
