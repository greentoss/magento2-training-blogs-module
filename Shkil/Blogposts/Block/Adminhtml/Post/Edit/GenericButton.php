<?php

namespace Shkil\Blogposts\Block\Adminhtml\Post\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\UrlInterface;

class GenericButton
{
    /**
     * Url Builder
     *
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        $this->urlBuilder = $context->getUrlBuilder();
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}

