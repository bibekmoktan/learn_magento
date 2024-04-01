<?php
namespace Extension\ExtensionAttribute\Model;
class Product extends \Magento\Catalog\Model\Product
{
    public function getName(){
        $name = parent :: getName();
        $price =$this->getData('price');

        if($price < 80 ){
            $name.=" it is cheap product";
        }
        else
            $name.="it is expensive";
        return $name;
    }
}
?>
