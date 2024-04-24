<?php
namespace Codilar\BookTask\Model\Api;

use Codilar\BookTask\Api\Book\BookInterface;
use Codilar\BookTask\Api\BookRepositoryInterface;
use Codilar\BookTask\Model\DataFactory;
use Codilar\BookTask\Model\ResourceModel\Data as ObjectResourceModel;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class BookRepository implements BookRepositoryInterface
{
    protected $dataFactory;
    protected $resource;
    public function __construct(DataFactory $dataFactory, ObjectResourceModel $resource)
    {
        $this->dataFactory = $dataFactory;
        $this->resource = $resource;
    }
    public function save(BookInterface $book)
    {
        try {
            $this->resource->save($book);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return $book;
    }
    public function getById($id)
    {
        $object = $this->dataFactory->create();
        $this->resource->load($object, $id);
        if (!$object->getId()) {
            throw new NoSuchEntityException(__('Object with id "%1" does not exist.', $id));
        }
        return $object;
    }
}
