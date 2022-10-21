<?php

namespace Shkil\Blogposts\Plugin;

use Shkil\Blogposts\Api\Data\PostInterface;
use Shkil\Blogposts\ViewModel\BlogViewModel;

class PostsChangeDateFormat
{
    /**
     * @param BlogViewModel $subject
     * @param PostInterface $post
     * @return PostInterface
     */
    public function afterGetPost(BlogViewModel $subject, PostInterface $post)
    {
        $date = $post->getCreatedAt();
        $date = strtotime($date);
        $date = date('d-m-Y', $date);
        $post->setCreatedAt($date);
        return $post;
    }
}
