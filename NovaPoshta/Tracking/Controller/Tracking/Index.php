<?php
declare(strict_types=1);

namespace NovaPoshta\Tracking\Controller\Tracking;

use Magento\Authorization\Model\UserContextInterface;
use Magento\Framework\App\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use NovaPoshta\Tracking\Model\Tracking;

class Index extends Action\Action
{

    /**
     * @var UserContextInterface
     */
    private $userContext;

    /**
     * @var Tracking
     */
    private $tracking;

    public function __construct(Context $context, UserContextInterface $userContext, Tracking $tracking)
    {
        parent::__construct($context);
        $this->userContext = $userContext;
        $this->tracking = $tracking;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        if ($this->userContext->getUserType() === UserContextInterface::USER_TYPE_CUSTOMER) {
            $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            if ($ttn = $this->getRequest()->getParam('ttn')) {
                $output = $this->tracking->track($ttn);

                $block = $resultPage->getLayout()->getBlock('novap.main');
                $block->setData('info', $output);
            }

            return $resultPage;
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setPath("customer/account/login");
    }
}
