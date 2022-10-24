<?php

namespace Shkil\Blogposts\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface PostInterface extends ExtensibleDataInterface
{
    const POST_ID = 'post_id';
    const AUTHOR = 'author';
    const BODY = 'body';
    const TITLE = 'title';
    const CREATED_AT = 'created_at';

    /**
     * @return integer
     */
    public function getPostId();

    /**
     * @return string|null
     */
    public function getAuthor();

    /**
     * @return string|null
     */
    public function getBody();

    /**
     * @return string|null
     */
    public function getTitle();

    /**
     * @return string|null
     */
    public function getCreatedAt();


    /**
     * @param integer $postId
     * @return $this
     */
    public function setPostId($postId);

    /**
     * @param string $code
     * @return $this
     */
    public function setAuthor($author);

    /**
     * @param string $body
     * @return $this
     */
    public function setBody($body);

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);
}
