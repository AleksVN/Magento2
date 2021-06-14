<?php

namespace Voloshkov\News\Controller\Adminhtml\Alllist;

use Magento\Backend\App\AbstractAction;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

/**
 * Create or edit one item
 */
class Edit extends Action
{

    /**
     * @var \Voloshkov\News\Model\ResourceModel\NewsRepository
     */
    private $newsRepository;
    /**
     * @var \WAVN\FixSalesOrders\Model\OrdersValidator
     */
    private $ordersValidators;

    public function __construct(
        Context $context,
\WAVN\FixSalesOrders\Model\OrdersValidator $ordersValidator,
        \Voloshkov\News\Model\ResourceModel\NewsRepository $newsRepository
    ) {
        parent::__construct($context);
        $this->newsRepository = $newsRepository;
        $this->ordersValidators = $ordersValidator;
    }

    public function execute()
    {

     $test =  $this->ordersValidators->execute();

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $id = $this->getRequest()->getParam('news_id');

        $dto = $this->newsRepository->getById((int)$id);

        $container = $resultPage->getLayout()->getBlock('adminhtml.news.form.container');
//        $container2 = $resultPage->getLayout()->getBlock('adminhtml.news.status.container.main');
        $container3 = $resultPage->getLayout()->getBlock('adminhtml.news.status.container2');
        $childBlock = $container3->getChildBlock('status.main');


//        $tabs = $resultPage->getLayout()->getBlock('adminhtml.user.edit.tabs');
       // $block = $tabs->getChildBlock('test_block');
        $container->getChildBlock('form')->setData('dto', $dto);
        //$block->setData('dto', $dto);
//        $container->setData('dto', $dto);
//        $container2->setData('dto', $dto);
        $childBlock->setData('dto', $dto);
        $childBlock->setData('mode', 'grid');

       // $this->_view->renderLayout();
       return $resultPage;
    }
}
