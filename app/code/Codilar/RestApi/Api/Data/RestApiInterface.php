<?php

namespace Rest\RestApi\Api\Data;

/**
 * Interface RestApiInterface
 * @package Rest\RestApi\Api\Data
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
    public function getName();

    /**
     * Set Name
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name): RestApiInterface;

    /**
     * Get Last Name
     *
     * @return string|null
     */
    public function getlName();

    /**
     * Set Last Name
     *
     * @param string $lName
     * @return $this
     */
    public function setlName(string $lName): RestApiInterface;
}
