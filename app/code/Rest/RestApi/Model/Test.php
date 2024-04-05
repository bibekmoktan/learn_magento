<?php
namespace Rest\RestApi\Model;

use Rest\RestApi\Api\Data\RestApiInterface;

class Test implements RestApiInterface{

    private $posts = [
        [
            "id" => 1,
            "title" => " My post 1",
            "categories" => [" My post 1", "Custom Post"],
            "description" => "Hello world"
        ],
        [
        "id" => 2,
        "title" => " My post 1",
        "categories" => [" My post 1", "Custom Post"],
        "description" => "Hello world"
        ],
        [
            "id" => 3,
            "title" => " My post 1",
            "categories" => [" My post 1", "Custom Post"],
            "description" => "Hello world"
        ]
    ];
    public function getAllPost():array
    {
        return $this->posts;
    }
    /**
     * @return array
 *  @param int $id
 */
    public function getPost(int $id): array
    {
        $posts =$this->getAllPost();
        if(empty($posts)){
            return [];
        }
        $postData = [];
         foreach ($posts as $post){
             if($id == $post['id']){
                 $postData[] = $post;
                 break;
             }
         }
         return $postData;
    }
}
?>
