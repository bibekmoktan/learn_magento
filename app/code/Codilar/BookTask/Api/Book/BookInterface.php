<?php
namespace Codilar\BookTask\Api\Book;


interface BookInterface
{
    /**
     * Get Person ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set Person ID
     *
     * @param int $id
     * @return $this
     */
    public function setId(int $id): BookInterface;

    /**
     * Get Name
     *
     * @return string|null
     */
    public function getIsbn();

    /**
     * Set Name
     *
     * @param string $isbn
     * @return $this
     */
    public function setIsbn(string $isbn): BookInterface;

    /**
     * Get Last Name
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Set Last Name
     *
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): BookInterface;

    /**
     * Get Last Name
     *
     * @return string|null
     */
    public function getAuthorName();

    /**
     * Set Last Name
     *
     * @param string $author
     * @return $this
     */
    public function setAuthorName(string $author): BookInterface;

    /**
     * Get Last Name
     *
     * @return string|null
     */
    public function getCategory();

    /**
     * Set Last Name
     *
     * @param string $category
     * @return $this
     */
    public function setCategory(string $category): BookInterface;

    /**
     * Get Last Name
     *
     * @return string|null
     */
    public function getPrice();

    /**
     * Set Last Name
     *
     * @param string $price
     * @return $this
     */
    public function setPrice(string $price): BookInterface;
}
