<?php
namespace Rest\RestApi\Api;
interface RestApiRepositoryInterface
{

    /**
     * get test Api data.
     *
     * @api
     *
     * @param int $id
     *
     * @return \Rest\RestApi\Api\Data\RestApiInterface
     */
    public function getById(int $id);


}
