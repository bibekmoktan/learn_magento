<?php

namespace Codilar\TaskAttribute\Plugin;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Catalog\Api\Data\ProductExtensionFactory;

class Product
{
    /**
     * @var ProductCollectionFactory
     */
    private $productCollectionFactory;

    /**
     * @var ProductExtensionFactory
     */
    private $extensionFactory;

    public function __construct(
        ProductCollectionFactory $productCollectionFactory,
        ProductExtensionFactory $extensionFactory
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->extensionFactory = $extensionFactory;
    }

    public function afterGet(
        ProductRepositoryInterface $subject,
        ProductInterface $product
    ) {
        // Check if the extension attribute already exists
        if ($product->getExtensionAttributes() && $product->getExtensionAttributes()->getIsFeatured() !== null) {
            return $product;
        }

        // Retrieve is_featured value
        $isFeatured = $this->getIsFeatured($product->getId());

        // Create extension attributes object if not present
        $extensionAttributes = $product->getExtensionAttributes() ?: $this->extensionFactory->create();

        // Set is_featured extension attribute
        $extensionAttributes->setIsFeatured($isFeatured);

        // Set extension attributes on product
        $product->setExtensionAttributes($extensionAttributes);

        return $product;
    }

    /**
     * Retrieve is_featured value for a product
     *
     * @param int $productId
     * @return bool
     */
    private function getIsFeatured($productId)
    {
        return (bool)$this->productCollectionFactory->create()
            ->addFieldToFilter('entity_id', $productId)
            ->addFieldToSelect('is_featured')
            ->getFirstItem()
            ->getData('is_featured');
    }
}
