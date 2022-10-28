<?php

namespace Shkil\Blogposts\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Ui\Component\MassAction\Filter;
use Shkil\Blogposts\Api\PostRepositoryInterface;
use Shkil\Blogposts\Model\ResourceModel\Post\CollectionFactory;

class MassDelete extends Action implements HttpPostActionInterface
{
    /**
     * @var Filter
     */
    protected Filter $filter;
    /**
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;
    /**
     * @var PostRepositoryInterface
     */
    private PostRepositoryInterface $postRepository;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        PostRepositoryInterface $postRepository
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->postRepository = $postRepository;
        parent::__construct($context);
    }

    /**
     * @return Redirect
     * @throws NotFoundException
     * @throws LocalizedException
     */
    public function execute(): Redirect
    {
        if (!$this->getRequest()->isPost()) {
            throw new NotFoundException(__('Page not found'));
        }

        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $postDeleted = 0;

        foreach ($collection->getItems() as $post) {
            $this->postRepository->delete($post);
            $postDeleted++;
        }

        if ($postDeleted) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $postDeleted)
            );
        }

        return $this->resultFactory
            ->create(ResultFactory::TYPE_REDIRECT)
            ->setPath('blog/post/index');
    }
}
