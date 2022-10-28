<?php

namespace Shkil\Blogposts\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Shkil\Blogposts\Api\PostRepositoryInterface;

class InlineEdit extends Action
{
    const ADMIN_RESOURCE = 'Shkil_Blogposts::blog';

    /**
     * @var JsonFactory
     */
    protected JsonFactory $jsonFactory;
    /**
     * @var PostRepositoryInterface
     */
    private PostRepositoryInterface $postRepository;

    public function __construct(
        Action\Context $context,
        JsonFactory $jsonFactory,
        PostRepositoryInterface $postRepository
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->postRepository = $postRepository;
        parent::__construct($context);
    }

    /**
     * @return Json
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);

            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $postId) {
                    $post = $this->postRepository->getById($postId);
                    try {
                        $post->setData(array_merge($post->getData(), $postItems[$postId]));
                        $this->postRepository->save($post);
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithBlockId($post, __($e->getMessage()));
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
