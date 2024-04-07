<?php
namespace Codilar\RestApi\Api;
interface RestApiRepositoryInterface
{

    /**
     * get test Api data.
     *
     * @api
     *
     * @param int $id
     *
     * @return \Codilar\RestApi\Api\Data\RestApiInterface
     */
    public function getById(int $id);


}
