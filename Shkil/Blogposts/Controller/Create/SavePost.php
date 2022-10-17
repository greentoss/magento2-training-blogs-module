<?php

namespace Shkil\Blogposts\Controller\Create;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Shkil\Blogposts\Api\PostRepositoryInterface;
use Shkil\Blogposts\Model\PostFactory;

class SavePost extends Action
{
    private $postFactory;
    private $postRepository;

    public function __construct(
        Context $context,
        PostFactory $postFactory,
        PostRepositoryInterface $postRepository
    )
    {
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
        return parent::__construct($context);
    }

    public function execute()
    {
        echo "123"; die();
        try {
            $post = $this->postFactory->create();

            $post->setAuthor($this->getRequest()->getParam('author'));
            $post->setTitle($this->getRequest()->getParam('title'));
            $post->setBody($this->getRequest()->getParam('body'));

            $this->postRepository->save($post);
//            echo "123"; die();
            $resultRedirect = $this->resultRedirectFactory->create();

            $this->messageManager->addSuccessMessage(__('You created a new post!'));

            return $resultRedirect->setPath('blog/index/index');
        } catch (\Exception $ex) {
            $this->messageManager->addErrorMessage($ex, __("We can\'t create your post, Something went wrong."));
        }
    }
}
