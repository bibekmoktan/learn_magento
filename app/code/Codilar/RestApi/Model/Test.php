<?php

namespace Codilar\RestApi\Model;

use Codilar\BookTask\Model\ResourceModel\Data as ResourceModel;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Codilar\RestApi\Api\Data\RestApiInterface;

/**
 * Class Test
 *
 * @package Codilar\RestApi\Model\Api
 */
class Test extends AbstractModel implements RestApiInterface ,IdentityInterface
{
    const CACHE_TAG = 'book_info';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    /**
     * Retrieve Person ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData('id');
    }

    /**
     * Set Person ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id): RestApiInterface
    {
        return $this->setData('id', $id);
    }

    /**
     * Retrieve Name
     *
     * @return string|null
     */
    public function getIsbn()
    {
        return $this->getData('isbn');
    }

    /**
     * Set Name
     *
     * @param string $isbn
     * @return $this
     */
    public function setIsbn($isbn): RestApiInterface
    {
        return $this->setData('isbn', $isbn);
    }
    /**
     * Retrieve Last Name
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getData('title');
    }
    /**
     * Set Last Name
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title): RestApiInterface
    {
        return $this->setData('lName', $title);
    }

    /**
     * Retrieve Last Name
     *
     * @return string|null
     */
    public function getAuthorName()
    {
        return $this->getData('author_name');
    }
    /**
     * Set Last Name
     *
     * @param string $author
     * @return $this
     */
    public function setAuthorName(string $author): RestApiInterface
    {
        return $this->setData('author_name', $author);
    }

    /**
     * Retrieve Last Name
     *
     * @return string|null
     */
    public function getCategory()
    {
        return $this->getData('category');
    }
    /**
     * Set Last Name
     *
     * @param string $category
     * @return $this
     */
    public function setCategory($category): RestApiInterface
    {
        return $this->setData('category', $category);
    }

    /**
     * Retrieve Last Name
     *
     * @return string|null
     */
    public function getPrice()
    {
        return $this->getData('price');
    }
    /**
     * Set Last Name
     *
     * @param string $price
     * @return $this
     */
    public function setPrice($price): RestApiInterface
    {
        return $this->setData('price', $price);
    }
}
