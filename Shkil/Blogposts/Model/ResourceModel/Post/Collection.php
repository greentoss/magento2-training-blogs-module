<?php

namespace Shkil\Blogposts\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Shkil\Blogposts\Model\Post;
use Shkil\Blogposts\Model\ResourceModel\Post as PostResource;


class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init( Post::class, PostResource::class);
    }
}
