<?php
namespace Test\HelloWorld\Block;


class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getHelloWorldMessage()
    {
        date_default_timezone_set('Asia/Kolkata');
        $hour= date('G');
        if($hour < 12){
            return __('hello world! ');
        }
        elseif ($hour < 16){
          return  __('hello world! Good Evening');
        }
        else
        {
            return __('hello world! Good Night');
        }
    }
}
