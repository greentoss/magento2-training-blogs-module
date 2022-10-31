<?php

namespace Shkil\Blogposts\Cron;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Psr\Log\LoggerInterface;
use Shkil\Blogposts\Api\PostRepositoryInterface;

class LogPosts
{
    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;
    /**
     * @var PostRepositoryInterface
     */
    private PostRepositoryInterface $postRepository;
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        PostRepositoryInterface $postRepository,
        LoggerInterface $logger
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->postRepository = $postRepository;
        $this->logger = $logger;
    }

    public function execute()
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('created_at', strtotime(' -1 day'), 'gt')
            ->create();
        $posts = $this->postRepository->getList($searchCriteria);
        $this->logger->info(__('Today %1 posts have been created', count($posts->getItems())));
    }
}
