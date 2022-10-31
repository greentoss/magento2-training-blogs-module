<?php

namespace Shkil\Blogposts\Observer;

use Exception;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\ResourceModel\Customer as CustomerResource;
use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class CustomerPostCount implements ObserverInterface
{
    /**
     * @var Session
     */
    private $customer;
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;
    /**
     * @var CustomerResource
     */
    private $customerResource;
    /**
     * @var CustomerFactory
     */
    private $customerFactory;

    public function __construct (
        Session $customer,
        CustomerRepositoryInterface $customerRepository,
        CustomerResource $customerResource,
        CustomerFactory $customerFactory,
    )
    {
        $this->customer = $customer;
        $this->customerRepository = $customerRepository;
        $this->customerResource = $customerResource;
        $this->customerFactory = $customerFactory;
    }

    /**
     * @param EventObserver $observer
     * @return $this|void
     */
    public function execute(EventObserver $observer)
    {
//        $post = $observer->getEvent()->getData('post');
//        if (!$post) {
//            return $this;
//        }
        // if post doesn't exist, observer does nothing
        $customerId = $this->customer->getCustomerId();

        try {
//            $customer = $this->customerRepository->getById($customerId);
//            $blogposts = (int) $customer->getCustomerAttribute('blogposts') + 1;
//            $this->customerRepository->save($customer);
            $customer = $this->customerFactory->create();
            $this->customerResource->load($customer, $customerId);
            $blogposts = (int) $customer->getData('blogposts') + 1;
            $customer->setData('blogposts', $blogposts);
            $this->customerResource->save($customer);
        } catch (Exception $e) {
            //TODO: Logger
        }
        return $this;
    }
}
