<?php
namespace Shkil\Blogposts\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionInterface;

class Router implements RouterInterface
{
    /**
     * @var ActionFactory
     */
    protected ActionFactory $actionFactory;

    /**
     * @var ResponseInterface
     */
    protected ResponseInterface $_response;

    public function __construct(
        ActionFactory $actionFactory,
        ResponseInterface $response
    ) {
        $this->actionFactory = $actionFactory;
        $this->_response = $response;
    }

//    www.mysite/offers/promotions/index/id/5
//    http://magento2-training22.com/blog/post/view/id/3/

    public function match(RequestInterface $request) : ?ActionInterface
    {
        $identifier = trim($request->getPathInfo(), '/');

        $id = '';
        if (strpos($identifier, 'post') !== false) {

//            $finalKey = explode('/', $identifier);
//            $urlKey = end($finalKey);
//
//            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
//            $offerModel = $objectManager->get('Namespace\Vendor\Model\Offers')->load($urlKey,'url-key');
//            if($offerModel->getId()) {
//            $id = $offerModel->getId();
//            }
//
//            if($id) {
//                $request->setModuleName('blogs')-> //module name
//                setControllerName('posts')-> //controller name
//                setActionName('index')-> //action name
//                setParam('id', $id); //custom parameters
//            }
            return $this->actionFactory->create(
                Forward::class,
                ['request' => $request]
            );
        }

        return null;
    }
}
