<?php

namespace Rest\RestApi\Model;

use Crud\Test\Model\ResourceModel\Data as ResourceModel;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Rest\RestApi\Api\Data\RestApiInterface;

/**
 * Class Test
 *
 * @package Rest\RestApi\Model\Api
 */
class Test extends AbstractModel implements RestApiInterface ,IdentityInterface
{
    const CACHE_TAG = 'info';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    /**
     * Retrieve Person ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData('id');
    }

    /**
     * Set Person ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id): RestApiInterface
    {
        return $this->setData('id', $id);
    }

    /**
     * Retrieve Name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getData('name');
    }

    /**
     * Set Name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name): RestApiInterface
    {
        return $this->setData('name', $name);
    }
    /**
     * Retrieve Last Name
     *
     * @return string|null
     */
    public function getlName()
    {
        return $this->getData('lName');
    }
    /**
     * Set Last Name
     *
     * @param string $lName
     * @return $this
     */
    public function setlName($lName): RestApiInterface
    {
        return $this->setData('lName', $lName);
    }
}
