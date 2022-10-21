<?php

namespace Shkil\Blogposts\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements ActionInterface
{
    protected PageFactory $_pageFactory;

    public function __construct(
        PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
