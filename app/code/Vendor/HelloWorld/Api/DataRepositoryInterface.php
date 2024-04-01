<?php
namespace Vendor\HelloWorld\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Vendor\HelloWorld\Api\Data\DataInterface;

interface DataRepositoryInterface
{
    public function save(DataInterface $data);
    public function getById($id);
    public function getList(SearchCriteriaInterface $criteria);
    public function delete(DataInterface $data);
    public function deleteById($id);
}
