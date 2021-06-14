<?php


namespace Voloshkov\News\Controller\Adminhtml\Alllist;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

/**
 * Delete one item
 */
class Delete extends Action
{

    /**
     * @var \Voloshkov\News\Model\ResourceModel\NewsRepository
     */
    private $newsRepository;

    public function __construct(
        Context $context,
        \Voloshkov\News\Model\ResourceModel\NewsRepository $newsRepository
    ) {
        parent::__construct($context);
        $this->newsRepository = $newsRepository;
    }

    /**
     * @inheridoc
     */
    public function execute()
    {
        $id = (int)$this->getRequest()->getParam('news_id');
        $dto = $this->newsRepository->getById($id);
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        if ($dto->getId() !== null){

            if ($this->newsRepository->deleteById($id)) {
                $this->messageManager->addSuccessMessage(__('Deleted'));
            }
        } else {
            $this->messageManager->addErrorMessage(__('Not deleted'));
        }

        return $resultRedirect->setPath('news/alllist/index');
    }
}
