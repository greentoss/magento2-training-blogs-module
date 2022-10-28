<?php

namespace Shkil\Blogposts\Plugin;

use Shkil\Blogposts\Api\Data\PostInterface;
use Shkil\Blogposts\Helper\Data;
use Shkil\Blogposts\ViewModel\BlogViewModel;

class PostsChangeDateFormat
{
    /**
     * @var Data
     */
    private Data $helper;

    public function __construct(
        Data $helper
    )
    {
        $this->helper = $helper;
    }
    /**
     * @param BlogViewModel $subject
     * @param PostInterface $post
     * @return PostInterface
     */
    public function afterGetPost(BlogViewModel $subject, PostInterface $post)
    {
        $dateFormat = $this->helper->getDateFormat();

        $date = $post->getCreatedAt();
        $date = strtotime($date);
//        $date = date('d-m-Y', $date);
        $date = date($dateFormat, $date);

        $post->setCreatedAt($date);
        return $post;
    }
}
