<?php

namespace Codilar\BookTask\Block;

use  Codilar\BookTask\Model\ResourceModel\Data\Collection;
use Magento\Framework\View\Element\Template;

class Display extends Template
{
    /**
     * @var Collection
     */
    private $collection;

    /**
     * Display constructor.
     * @param Template\Context $context
     * @param Collection $collection
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Collection $collection,
        array $data = []
    ) {
        $this->collection = $collection;
        parent::__construct($context, $data);
    }

    /**
     * @return Collection
     */
    public function getAllData()
    {
        return $this->collection;
    }

    /**
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->getUrl('book/index/save');
    }

    /**
     * @return string
     */
    public function getEditPageUrl()
    {
        return $this->getUrl('book/index/edit');
    }
    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('book/index/delete');
    }
}
