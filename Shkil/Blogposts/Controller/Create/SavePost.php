<?php

namespace Shkil\Blogposts\Controller\Create;

use Exception;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Event\ManagerInterface as EventManagerInterface;
use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;
use Shkil\Blogposts\Api\PostRepositoryInterface;
use Shkil\Blogposts\Model\PostFactory;

class SavePost implements ActionInterface
{
    private PostFactory $postFactory;
    private PostRepositoryInterface $postRepository;
    private EventManagerInterface $eventManager;
    private MessageManagerInterface $messageManager;
    private RedirectFactory $resultRedirectFactory;
    private Http $request;

    /**
     * @param PostFactory $postFactory
     * @param PostRepositoryInterface $postRepository
     * @param Http $request
     * @param MessageManagerInterface $messageManager
     * @param RedirectFactory $resultRedirectFactory
     * @param EventManagerInterface $eventManager
     */
    public function __construct(
        PostFactory $postFactory,
        PostRepositoryInterface $postRepository,
        Http $request,
        MessageManagerInterface $messageManager,
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
    }

    public function execute()
    {
        try {
            $post = $this->postFactory->create();

            $post->setAuthor($this->request->getParam('author'));
            $post->setTitle($this->request->getParam('title'));
            $post->setBody($this->request->getParam('body'));

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
