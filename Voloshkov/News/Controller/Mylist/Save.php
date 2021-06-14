<?php

namespace Voloshkov\News\Controller\Mylist;

use Magento\Framework\App\Action\Action;
use Magento\Authorization\Model\UserContextInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Escaper;

/**
 * Save one item
 */
class Save extends Action
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

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var \Magento\Framework\Escaper
     */
    private $escaper;

    public function __construct(
        Context $context,
        \Voloshkov\Services\VerifyChek $verifyChek,
        \Magento\Customer\Model\Session $customerSession,
        \Voloshkov\News\Model\ResourceModel\NewsRepository $newsRepository,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        Escaper $escaper

    ) {
        parent::__construct($context);
        $this->customerSession = $customerSession;
        $this->verifyChek = $verifyChek;
        $this->newsRepository = $newsRepository;
        $this->scopeConfig = $scopeConfig;
        $this->escaper = $escaper;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $dto = $this->newsRepository->getById((int)$id);
        $customerId = $this->customerSession->getCustomerId();

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        if ($this->verifyChek->checkUsersType()) {
                                    // ??
           if ($dto->getId() === null || $this->verifyChek->VerifyOwn($id)) {

                $title = $this->getRequest()->getParam('title');
                $description = $this->getRequest()->getParam('description');
                $content = $this->getRequest()->getParam('content');
                $nameCategory = $this->getRequest()->getParam('nameCategory');

                if ($dto->getId() === null) {
                    $dto->setNewsCustomerId($customerId);
                }
                $dto->setTitle($title);
                $dto->setDescription($description);
                $config = $this->scopeConfig->getValue('news_section/general/html_content', \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE);
                if ($config) {
                    $content = $this->escaper->escapeHtml($content);
                }
                $dto->setContent($content);
                $dto->setCategoryNews($nameCategory);

//save news_cust_id! where ??
                $this->newsRepository->save($dto);

                $this->messageManager->addSuccessMessage(__('Saved'));
                $resultRedirect->setPath("*/*/viewone/id/{$dto->getId()}");

                return $resultRedirect;
            }
        }
        $this->messageManager->addErrorMessage(__('Save: not found'));
        return $resultRedirect->setPath("news/mylist/all");
    }

}
