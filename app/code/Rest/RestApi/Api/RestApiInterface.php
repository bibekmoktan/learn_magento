<?php
namespace Rest\RestApi\Api;


interface RestApiInterface
{
    /**
     * Get All Post
     * @return array
     */
    public function getAllPost():array;


/**
* @param int $id
* @return array
 *
*/
    public function getPost(int $id):array;
}
