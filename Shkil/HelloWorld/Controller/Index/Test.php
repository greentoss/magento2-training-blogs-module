<?php

namespace Shkil\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;

class Test extends Action
{
    protected $_pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        echo "Hello World 1234";
        exit;
    }
}
