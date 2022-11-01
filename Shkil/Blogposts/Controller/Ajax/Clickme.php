<?php

namespace Shkil\Blogposts\Controller\Ajax;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Json\Helper\Data;
use Magento\Framework\View\Result\PageFactory;

class Clickme extends Action implements HttpPostActionInterface
{
    /**
     * @var PageFactory
     */
    private PageFactory $pageFactory;

    /**
     * @var Validator
     */
    private Validator $validator;
    /**
     * @var Data
     */
    private Data $jsonHelper;

    public function __construct (
        Context $context,
        PageFactory $pageFactory,
        Validator $validator,
        Data $jsonHelper
    )
    {
        $this->pageFactory = $pageFactory;
        $this->validator = $validator;
        $this->jsonHelper = $jsonHelper;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        if (!$this->validator->validate($this->getRequest())) {
            return$resultRedirect->setRefererUrl();
        }

        $result = [
            'success' => true,
            'message' => 'I have been clicked by AJAX'
        ];

        return $this->getResponse()->representJson(
            $this->jsonHelper->jsonEncode($result)
        );
    }
}
