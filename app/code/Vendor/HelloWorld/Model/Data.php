<?php

namespace Vendor\HelloWorld\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Vendor\HelloWorld\Api\Data\DataInterface;
use Vendor\HelloWorld\Model\ResourceModel\Data as ResourceModel;

class Data extends AbstractModel implements DataInterface, IdentityInterface
{
    const CACHE_TAG = 'book_table';

    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getBookId()];
    }

    public function getBookId()
    {
        return $this->getData('book_id');
    }

    public function setBookId($bookId)
    {
        return $this->setData('book_id', $bookId);
    }

    public function getAuthorName()
    {
        return $this->getData('aurthor');
    }
    public function setAuthorName($authorName)
    {
        return $this->setData('aurthor', $authorName);
    }

    public function getTitle()
    {
        return $this->getData('title');
    }

    public function setTitle($title)
    {
        return $this->setData('title', $title);
    }
    public function getPublishedDate()
    {
        return $this->getData('Published_date');
    }
    public function setPublishedDate($date)
    {
        return $this->setData('published_date', $date);
    }

}
