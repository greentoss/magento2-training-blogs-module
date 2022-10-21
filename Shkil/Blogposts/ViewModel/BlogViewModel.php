<?php

namespace Shkil\Blogposts\ViewModel;

use Exception;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Shkil\Blogposts\Api\Data\PostInterface;
use Shkil\Blogposts\Api\PostRepositoryInterface;
use Psr\Log\LoggerInterface;

class BlogViewModel implements ArgumentInterface
{
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        PostRepositoryInterface $postRepository,
        RequestInterface $request,
        LoggerInterface $logger
    )
    {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->postRepository = $postRepository;
        $this->request = $request;
        $this->logger = $logger;
    }

    /**
     * @return PostInterface[]
     */
    public function getList()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        try {
            $posts = $this->postRepository->getList($searchCriteria);
        } catch (Exception $exception) {
            $posts = null;
            $this->logger->error($exception->getMessage());
        }

        return $posts ? $posts->getItems() : [];
    }

    /**
     * @return null|PostInterface
     */
    public function getPost()
    {
        $id = $this->request->getParam('id');

        try {
            $post = $this->postRepository->getById($id);
        } catch (Exception $exception) {
            $post = null;
            $this->logger->error($exception->getMessage());
        }

        return $post;
    }
}

