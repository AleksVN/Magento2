<?php


namespace Voloshkov\News\Controller\Mylist;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

/**
 * Delete one item
 */
class Delete extends Action
{
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
        \Voloshkov\News\Model\ResourceModel\NewsRepository $newsRepository
    ) {
        parent::__construct($context);
        $this->verifyChek = $verifyChek;
        $this->newsRepository = $newsRepository;
    }

    /**
     * @inheridoc
     */
    public function execute()
    {
        $id = (int)$this->getRequest()->getParam('id');
        $dto = $this->newsRepository->getById($id);
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        if ($dto->getId() !== null && $this->verifyChek->checkUsersType() && $this->verifyChek->VerifyOwn($id)) {

            if ($this->newsRepository->deleteById($id)) {
                $this->messageManager->addSuccessMessage(__('Deleted'));
            }
        } else {
            $this->messageManager->addErrorMessage(__('Not deleted'));
        }

        return $resultRedirect->setPath('news/mylist/all');
    }
}
