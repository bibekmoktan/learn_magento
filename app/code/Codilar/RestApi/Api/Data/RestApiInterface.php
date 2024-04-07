<?php

namespace Codilar\RestApi\Api\Data;

/**
 * Interface RestApiInterface
 * @package Codilar\RestApi\Api\Data
 */
interface RestApiInterface
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
    public function setId(int $id): RestApiInterface;

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
    public function setIsbn(string $isbn): RestApiInterface;

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
    public function setTitle(string $title): RestApiInterface;

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
    public function setAuthorName(string $author): RestApiInterface;

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
    public function setCategory(string $category): RestApiInterface;

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
    public function setPrice(string $price): RestApiInterface;

}
