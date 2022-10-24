<?php

namespace Shkil\Blogposts\Controller\Create;

use Exception;


use Laminas\EventManager\EventManagerInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\App\RequestInterface;
use Shkil\Blogposts\Api\PostRepositoryInterface;
use Shkil\Blogposts\Model\PostFactory;

class SavePost implements ActionInterface
{
    private PostFactory $postFactory;
    private PostRepositoryInterface $postRepository;
    private EventManagerInterface $eventManager;
    private RequestInterface $request;
    private ManagerInterface $messageManager;
    private RedirectFactory $resultRedirectFactory;

    public function __construct(
        Context $context,
        PostFactory $postFactory,
        PostRepositoryInterface $postRepository,
        RequestInterface $request,
        ManagerInterface $messageManager,
        RedirectFactory $resultRedirectFactory,
        EventManagerInterface $eventManager
    )
    {
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
        $this->request = $request;
        $this->messageManager = $messageManager;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->eventManager = $eventManager;
//        return parent::__construct($context);
    }

    public function execute()
    {
        try {
            $post = $this->postFactory->create();

            $post->setAuthor($this->getRequest()->getParam('author'));
            $post->setTitle($this->getRequest()->getParam('title'));
            $post->setBody($this->getRequest()->getParam('body'));

            $this->eventManager->dispatch('blogpost_save_before', ['post' => $post]);
            $this->postRepository->save($post);
            $this->eventManager->dispatch('blogpost_save_after', ['post' => $post]);

            $resultRedirect = $this->resultRedirectFactory->create();
            $this->messageManager->addSuccessMessage(__('You created a new post!'));

            return $resultRedirect->setPath('blog/index/index');
        } catch (Exception $ex) {
            $this->messageManager->addErrorMessage($ex, __("We can\'t create your post, Something went wrong."));
        }
    }
}
