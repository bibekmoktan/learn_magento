<?php

namespace Codilar1\CustomCheckout\Observer;

use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Checkout\Model\Session as CheckoutSession;

class SaveData implements ObserverInterface
{
    protected $logger;
    protected $checkoutSession;

    public function __construct(LoggerInterface $logger,
                                CheckoutSession $checkoutSession)
    {
        $this->logger = $logger;
        $this->checkoutSession = $checkoutSession;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quote = $this->checkoutSession->getQuote();
        $extraFee = $quote->getCustomTaxAmount();
        $extraRate = $quote->getCustomTaxRate();

        $order = $observer->getOrder();
        $order->setData('custom_tax_amount', $extraFee);
        $order->setData('base_custom_tax_amount', $extraRate);

        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/test.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info('Order Information: ' . print_r($extraRate, true));

    }
}
