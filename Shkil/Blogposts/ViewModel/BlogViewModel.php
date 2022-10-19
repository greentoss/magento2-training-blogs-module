<?php

namespace Shkil\Blogposts\ViewModel;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Shkil\Blogposts\Api\PostRepositoryInterface;
use Shkil\Blogposts\Api\Data\PostInterface;

class BlogViewModel implements ArgumentInterface
{
    /**
     * @var $searchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var $postRepositoryInterface
     */
    private $postRepository;

    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        PostRepositoryInterface $postRepository
    )
    {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->postRepository = $postRepository;
    }

    /**
     * @return PostInterface[]
     */
    public function getList()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $posts = $this->postRepository->getList($searchCriteria);

        return $posts->getItems();
    }
}
