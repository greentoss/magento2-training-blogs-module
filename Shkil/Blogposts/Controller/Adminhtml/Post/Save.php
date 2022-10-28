<?php

namespace Shkil\Blogposts\Controller\Adminhtml\Post;

use Exception;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Shkil\Blogposts\Api\PostRepositoryInterface;
use Shkil\Blogposts\Model\PostFactory;

class Save extends Action
{
    const ADMIN_RESOURCE = 'Shkil_Blogposts::blog';

    /**
     * @var PostRepositoryInterface
     */
    private PostRepositoryInterface $postRepository;
    /**
     * @var PostFactory
     */
    private PostFactory $postFactory;

    public function __construct(
        Action\Context $context,
        PostRepositoryInterface $postRepository,
        PostFactory $postFactory
    ) {
        $this->postRepository = $postRepository;
        $this->postFactory = $postFactory;
        parent::__construct($context);
    }

    /**
     * @return Redirect
     * @throws LocalizedException
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $postId = $this->getRequest()->getParam('post_id');

        if ($data) {

            if ($postId) {
                try {
                    $post = $this->postRepository->getById($postId);
                } catch (NoSuchEntityException $e) {
                    $post = $this->postFactory->create();
                }
            } else {
                $post = $this->postFactory->create();
            }

            try {
                $post->setData($data);
                $this->postRepository->save($post);
                $this->messageManager->addSuccessMessage(__('Post was successfully saved'));
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('Error has happened during saving post: %1', $e->getMessage())
                );
            }
        }

        $resultRedirect = $this->resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/');
    }
}
