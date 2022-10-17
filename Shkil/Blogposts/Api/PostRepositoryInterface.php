<?php

namespace Shkil\Blogposts\Api;

interface PostRepositoryInterface
{
    /**
     * @param int $id
     * @return \Shkil\Blogposts\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param \Shkil\Blogposts\Api\Data\PostInterface $post
     * @return \Shkil\Blogposts\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Shkil\Blogposts\Api\Data\PostInterface $post);

    /**
     * @param \Shkil\Blogposts\Api\Data\PostInterface $post
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Shkil\Blogposts\Api\Data\PostInterface $post);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Shkil\Blogposts\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}
