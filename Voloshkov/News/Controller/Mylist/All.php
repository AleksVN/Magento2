<?php

namespace Voloshkov\News\Controller\Mylist;

use Magento\Framework\App\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Customer\Api\CustomerRepositoryInterface as CustomerRepository;

/**
 * Frontend view all items
 */
class All extends Action\Action
{
    /**
     * @param \Magento\Customer\Model\Session $customerSession
     */
    protected $_customerSession;

    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    private $repositoryCustomer;
    /**
     * @var \Voloshkov\Services\VerifyChek
     */
    private $verifyChek;

    public function __construct(
        Context $context,
        CustomerRepository $customerRepository,
        \Voloshkov\Services\VerifyChek $verifyChek,
        \Magento\Customer\Model\Session $customerSession
    ) {
        parent::__construct($context);
        $this->repositoryCustomer = $customerRepository;
        $this->verifyChek = $verifyChek;
        $this->_customerSession = $customerSession;
    }

    public function execute()
    {
        if (!$this->verifyChek->checkUsersType()) {
            $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setPath('customer/account/login');

            return $resultRedirect;
        }

        $customerId = $this->_customerSession->getCustomerId();
        $customer = $this->repositoryCustomer->getById($customerId);

        $extAtrib = $customer->getExtensionAttributes();

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $block = $resultPage->getLayout()->getBlock('mylist_all');
        $block->setData('all', $extAtrib->getNewsListCustomerId());

        return $resultPage;
    }

}
