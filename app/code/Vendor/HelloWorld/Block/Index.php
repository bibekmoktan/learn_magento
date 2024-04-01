<?php
namespace Vendor\HelloWorld\Block;



class
Index extends \Magento\Framework\View\Element\Template
{
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
