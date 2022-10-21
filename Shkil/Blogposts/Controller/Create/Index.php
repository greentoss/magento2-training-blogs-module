<?php

namespace Shkil\Blogposts\Controller\Create;

//use Magento\Framework\App\Action\Action;
//use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements ActionInterface
{
    protected PageFactory $_pageFactory;

    public function __construct(
//        Context $context,
        PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
//        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
