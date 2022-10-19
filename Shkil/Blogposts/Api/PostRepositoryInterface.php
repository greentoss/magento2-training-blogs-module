<?php

namespace Shkil\Blogposts\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Shkil\Blogposts\Api\Data\PostInterface;
use Shkil\Blogposts\Api\Data\PostSearchResultInterface;

interface PostRepositoryInterface
{

    /**
     * @param int $id
     * @return PostInterface
     * @throws NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param PostInterface $post
     * @return PostInterface
     */
    public function save($post);

    /**
     * @param PostInterface $post
     * @return void
     */
    public function delete($post);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return PostSearchResultInterface
     */
    public function getList($searchCriteria);
}
