<?php
namespace Codilar\RestApi\Model\Api;

use Codilar\BookTask\Model\DataFactory;
use Codilar\BookTask\Model\ResourceModel\Data as ObjectResourceModel;
use Magento\Framework\Exception\NoSuchEntityException;
use Codilar\RestApi\Api\RestApiRepositoryInterface;


/**
 * Class DataInterface
 */
class RestRepository implements RestApiRepositoryInterface
{
    private $dataFactory;
    protected $objectResourceModel;
    protected $collection;
    protected $searchResultsFactory;

    /**
     * DataInterface constructor.
     *
     * @param Data $dataFactory
     * @param ObjectResourceModel $objectResourceModel
     */
    public function __construct(
        DataFactory $dataFactory,
        ObjectResourceModel $objectResourceModel,
    ) {

        $this->dataFactory = $dataFactory;
        $this->objectResourceModel  = $objectResourceModel;
    }

//    public function save($data)
//    {
//
//    }
    /**
     * get test Api data.
     *
     * @api
     *
     * @param int $id
     *
     * @return \Codilar\RestApi\Api\Data\RestApiInterface
     */

    public function getById(int $id)
    {
        $object = $this->dataFactory->create();
        $this->objectResourceModel->load($object, $id);
        if (!$object->getId()) {
            throw new NoSuchEntityException(__('Object with id "%1" does not exist.', $id));
        }
        return $object;
    }
}
