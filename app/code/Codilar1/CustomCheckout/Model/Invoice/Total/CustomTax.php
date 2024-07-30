<?php

namespace Codilar1\CustomCheckout\Model\Invoice\Total;

use Magento\Sales\Model\Order\Invoice\Total\AbstractTotal;

class CustomTax extends AbstractTotal
{
    /**
     * @param \Magento\Sales\Model\Order\Invoice $invoice
     * @return $this
     */
    public function collect(\Magento\Sales\Model\Order\Invoice $invoice)
    {
        $invoice->setCustomTaxAmount(0);
        $invoice->setBaseCustomTaxAmount(0);

        $amount = $invoice->getOrder()->getCustomTaxAmount();
        $rate = $invoice->getOrder()->getBaseCustomTaxAmount();

        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom_tax.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info('Custom Tax Amount: ' .print_r($amount, true));

        $invoice->setCustomTaxAmount($amount);
        $invoice->setBaseCustomTaxAmount($rate);

        $invoice->setGrandTotal($invoice->getGrandTotal() + $amount);
        $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $amount);

        return $this;
    }
}
