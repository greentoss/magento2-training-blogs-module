<?php

namespace Shkil\Blogposts\Controller\Post;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\PageFactory;

class View implements ActionInterface
{
    private PageFactory $pageFactory;

    public function __construct(
        PageFactory $pageFactory
    )
    {
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
}
