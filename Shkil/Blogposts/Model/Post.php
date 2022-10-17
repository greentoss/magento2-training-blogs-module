<?php

namespace Shkil\Blogposts\Model;

use Magento\Framework\Model\AbstractExtensibleModel;

use Shkil\Blogposts\Api\Data\PostInterface;

class Post extends AbstractExtensibleModel implements PostInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Post::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getPostId()
    {
        return $this->getData(self::POST_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthor()
    {
        return $this->getData(self::AUTHOR);
    }

    /**
     * {@inheritdoc}
     */
    public function getBody()
    {
        return $this->getData(self::BODY);
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function setPostId($postId)
    {
        $this->setData(self::POST_ID, $postId);
    }

    /**
     * {@inheritdoc}
     */
    public function setAuthor($author)
    {
        $this->setData(self::AUTHOR, $author);
    }

    /**
     * {@inheritdoc}
     */
    public function setBody($body)
    {
        $this->setData(self::BODY, $body);
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $this->setData(self::TITLE, $title);
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt($createdAt)
    {
        $this->setData(self::CREATED_AT, $createdAt);
    }
}
