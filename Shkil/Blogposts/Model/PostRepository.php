<?php

namespace Shkil\Blogposts\Model;

use Exception;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Shkil\Blogposts\Api\Data\PostInterface;
use Shkil\Blogposts\Api\Data\PostSearchResultInterface;
use Shkil\Blogposts\Api\Data\PostSearchResultInterfaceFactory;
use Shkil\Blogposts\Api\PostRepositoryInterface;
use Shkil\Blogposts\Model\ResourceModel\Post;
use Shkil\Blogposts\Model\ResourceModel\Post\CollectionFactory;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @var PostFactory
     */
    private $postFactory;

    /**
     * @var Post
     */
    private $postResource;

    /**
     * @var PostCollectionFactory
     */
    private $postCollectionFactory;

    /**
     * @var PostSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    public function __construct(
        PostFactory                      $postFactory,
        Post                             $postResource,
        CollectionFactory                $postCollectionFactory,
        PostSearchResultInterfaceFactory $postSearchResultInterfaceFactory,
        CollectionProcessorInterface     $collectionProcessor
    ) {
        $this->postFactory = $postFactory;
        $this->postResource = $postResource;
        $this->postCollectionFactory = $postCollectionFactory;
        $this->searchResultFactory = $postSearchResultInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param int $id
     * @return PostInterface
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $post = $this->postFactory->create();
        $this->postResource->load($post, $id);
        if (!$post->getId()) {
            throw new NoSuchEntityException(__('Unable to find Post with ID "%1"', $id));
        }
        return $post;
    }

    /**
     * @param PostInterface $post
     * @return PostInterface
     * @throws LocalizedException|Exception
     */
    public function save($post)
    {
        $this->postResource->save($post);
        return $post;
    }

    /**
     * @param PostInterface $post
     * @return bool true on success
     * @throws CouldNotDeleteException
     */
    public function delete($post)
    {
        try {
            $this->postResource->delete($post);
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the entry: %1', $exception->getMessage())
            );
        }

        return true;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return PostSearchResultInterface
     */
    public function getList($searchCriteria)
    {
        $collection = $this->postCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}

