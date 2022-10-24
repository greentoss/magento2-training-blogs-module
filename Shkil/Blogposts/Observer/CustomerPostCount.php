<?php

namespace Shkil\Blogposts\Observer;

use Exception;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class CustomerPostCount implements ObserverInterface
{
    /**
     * @var Session
     */
    private Session $customer;

    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $customerRepository;

    public function __construct (
        Session $customer,
        CustomerRepositoryInterface $customerRepository
    )
    {
        $this->customer = $customer;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param EventObserver $observer
     * @return $this|void
     */
    public function execute(EventObserver $observer)
    {
        $post = $observer->getEvent()->getData('post');

        if (!$post) {
            return $this;
        }
        // if post doesn't exist, observer does nothing

//        $customerId = $this->customer->getCustomerId();
//
//        try {
//            $customer = $this->customerRepository->getById($customerId);
//            $blogposts = (int) $customer->getCustomerAttribute('blogposts') + 1;
//            $customer->setData('blogposts', $blogposts);
//            $this->customerRepository->save($customer);
//        } catch (Exception $e) {
//            //TODO: Logger
//        }
        return $this;
    }
}
