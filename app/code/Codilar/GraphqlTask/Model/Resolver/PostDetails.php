<?php

declare(strict_types=1);

namespace PracticeGraphql\Graphql\Model\Resolver;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Crud\Test\Model\DataFactory;

/**
 * Class BlogDetails
 */
class PostDetails implements ResolverInterface
{

    /**
     * PostFactory
     *
     * @var $postFactory
     */
    private $dataFactory;


    /**
     * Constructor
     *
     * @param DataFactory $dataFactory PostFactory.
     */
    public function __construct(
        DataFactory $dataFactory
    ) {
        $this->dataFactory = $dataFactory;

    }//end __construct()


    /**
     * Resolve Function
     *
     * @param Field       $field   Field.
     * @param Context     $context Context.
     * @param ResolveInfo $info    ResolveInfo.
     * @param array       $value   Array.
     * @param array       $args    Array.
     *
     * @throws GraphQlInputException GraphQlInputException.
     * @throws GraphQlNoSuchEntityException GraphQlNoSuchEntityException.
     *
     * @return array
     */
    public function resolve(
        Field $field,
              $context,
        ResolveInfo $info,
        array $value=null,
        array $args=null
    ) {

        $postData = [];

        $id         = $args['info_id'];
        $post = $this->dataFactory->create()->load($id);
        $postData   = $post->getData();
        //echo "<pre>";
        //print_r($postData); exit;
        return $postData;

    }

}//end class
