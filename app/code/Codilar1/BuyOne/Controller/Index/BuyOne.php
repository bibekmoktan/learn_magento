<?php

namespace Codilar1\BuyOne\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Codilar1\BuyOne\Helper\Data as BuyOneHelper;
use Magento\Framework\Controller\ResultFactory;

class BuyOne extends Action
{
    protected $buyOneHelper;

    public function __construct(Context $context, BuyOneHelper $buyOneHelper)
    {
        $this->buyOneHelper = $buyOneHelper;
        parent::__construct($context);
    }

    public function execute()
    {
        $textareaValues = $this->buyOneHelper->getTextareaFieldValue();
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        // Format the array output
        $formattedValues = '<pre>' . print_r($textareaValues, true) . '</pre>';
        $result->setContents('Textarea values: ' . $formattedValues);

        return $result;
    }
}
