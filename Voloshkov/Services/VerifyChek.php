<?php

namespace Voloshkov\Services;

use Magento\Authorization\Model\UserContextInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Voloshkov\News\Model\ResourceModel\NewsResource;

class VerifyChek
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    private $customerSession;

    /**
     * @var \Voloshkov\News\Model\ResourceModel\NewsRepository
     */
    private $newsRepository;
    /**
     * @var \Magento\Authorization\Model\UserContextInterface
     */
    private $userContext;

    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Voloshkov\News\Model\ResourceModel\NewsRepository $newsRepository,
        UserContextInterface $userContext
    )
    {
        $this->customerSession = $customerSession;
        $this->newsRepository = $newsRepository;
        $this->userContext = $userContext;
    }


    /**
     * @param int|string $id
     * @return bool
     */
    public function VerifyOwn($id)
    {
        $customerId = $this->customerSession->getCustomerId();

        ///$dto = $this->newsRepository->getById($id);
        ///$newsCustomerId = $dto->getNewsCustomerId();
        $w =   $this->newsRepository->getById($id);
        $newsCustomerId = $w->getNewsCustomerId();

//        $model = $this->factoryModel->create();
//        $this->resourceNews->load($model, $id);
//        $newsCustomerId = $model->getData('news_customer_id');

        if ($newsCustomerId == $customerId) {
            return true;
        }
        return false;
    }

    /**
     *
     *
     * @return bool
     */
    public function checkUsersType()
    {
        $userType = $this->userContext->getUserType();
        if ($userType == \Magento\Authorization\Model\UserContextInterface::USER_TYPE_CUSTOMER) {
            return true;
        }

        return false;
    }
}


