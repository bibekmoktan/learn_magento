<?php
namespace Codilar\BookTask\Model\Api;
use Codilar\BookTask\Api\Book\BookInterface;
use Codilar\BookTask\Model\ResourceModel\Data as ResourceModel;
use Codilar\BookTask\Api\BookRepositoryInterface;

class Book extends \Magento\Framework\Model\AbstractModel implements BookInterface
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
    public function setId($id):BookInterface
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
    public function setIsbn($isbn): BookInterface
    {
        return $this->setData('isbn', $isbn);
    }
    /**
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getData('title');
    }
    /**
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title): BookInterface
    {
        return $this->setData('title', $title);
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
    public function setAuthorName(string $author): BookInterface
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
    public function setCategory($category): BookInterface
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
    public function setPrice($price): BookInterface
    {
        return $this->setData('price', $price);
    }
}
