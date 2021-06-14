<?php

namespace Voloshkov\News\Controller\Mylist;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

/**
 * View one item
 */
class ViewOne extends Action
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;
    /**
     * @var \Voloshkov\Services\VerifyChek
     */
    private $verifyChek;
    /**
     * @var \Voloshkov\News\Model\ResourceModel\NewsRepository
     */
    private $newsRepository;

    public function __construct(
        Context $context,
        \Voloshkov\Services\VerifyChek $verifyChek,
        \Magento\Customer\Model\Session $customerSession,
        \Voloshkov\News\Model\ResourceModel\NewsRepository $newsRepository
    ) {
        parent::__construct($context);
        $this->customerSession = $customerSession;
        $this->verifyChek = $verifyChek;
        $this->newsRepository = $newsRepository;
    }

    public function execute()
    {
        $id = (int)$this->getRequest()->getParam('id');
        $dto = $this->newsRepository->getById($id);

       if($dto->getId() !== null && $this->verifyChek->checkUsersType() && $this->verifyChek->VerifyOwn($id)) {
                   $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

                   $block = $resultPage->getLayout()->getBlock('news_view_one');
                   $block->setData('dto', $dto);

                   return $resultPage;
               }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $this->messageManager->addErrorMessage(__('View: not found'));
        return $resultRedirect->setPath("news/mylist/all");
    }

}
