<?php
namespace Vendor\HelloWorld\Api\Data;

interface DataInterface
{
    public function getBookId();

    public function setBookId($bookId);

    public function getAuthorName();

    public function setAuthorName($authorName);

    public function getTitle();

    public function setTitle($title);

    public function getPublishedDate();

    public function setPublishedDate($date);

}
