<?php
namespace Codilar\BookTask\Api;

use Codilar\BookTask\Api\Book\BookInterface;

interface BookRepositoryInterface
{
    /**
     * Save book
     *
     * @param BookInterface $book
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(BookInterface $book);

    /**
     * Retrieve book by ID
     *
     * @param int $id
     * @return BookInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);
}
