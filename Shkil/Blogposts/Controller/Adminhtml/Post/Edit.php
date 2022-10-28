<?php
namespace Shkil\Blogposts\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Shkil\Blogposts\Api\PostRepositoryInterface;

class Edit extends Action implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    private PageFactory $resultPageFactory;
    /**
     * @var PostRepositoryInterface
     */
    private PostRepositoryInterface $postRepository;

    public function __construct(
        Context $context,
        PostRepositoryInterface $postRepository,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->postRepository = $postRepository;
        parent::__construct($context);
    }

    /**
     * @return Page|ResultInterface
     */
    public function execute()
    {
        $postId = $this->getRequest()->getParam('post_id', false);
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Shkil::Blog');

        if ($postId) {
            try {
                $post = $this->postRepository->getById($postId);
                $resultPage->getConfig()->getTitle()->prepend($post->getTitle());
            } catch (NoSuchEntityException $e) {
                //TODO:: Logger
            }
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('New Post'));
        }

        return $resultPage;
    }
}

