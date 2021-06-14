<?php


namespace Voloshkov\News\Controller\Adminhtml\Alllist;


use Magento\Backend\App\AbstractAction;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action implements HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'Voloshkov_News::index';
    /**
     * @var \Voloshkov\News\Model\ResourceModel\NewsResource\Collection
     */
    private $collection;


    public function __construct(Action\Context $context,
        \Voloshkov\News\Model\ResourceModel\NewsResource\Collection $collection)
    {
        $this->collection = $collection;
        parent::__construct($context);
    }

    public function execute()
    {

        $idy = 33;

        $resultPage =  $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $this->_setActiveMenu(\Voloshkov\News\Controller\Adminhtml\Alllist\Index::ADMIN_RESOURCE);

        /* отримуємо по імені екз обєкту з xml файлу з усіма його данними пропаисаними у тегах */
        $block = $resultPage->getLayout()->getBlock('news.grid');
        $resultPage->getConfig()->getTitle()->prepend(__('Grid'));
        /* вставляємо значення під ключом id. У ХМЛ це ж саме робить тег аргумент */
        $block->setData('id', 'news_id');
        /* до прикладу витягнули значення з ХМЛ */
        $dataFromXML = $block->getData('default_sort');
        $block->setData('dataSource', $this->collection);
        $block->setData('aydi', $idy);
        /* коли у ХМЛ ми маємо блок у блокові ми можеоо з батьківського блоку(обєкт) отримати дочірній блок(обєкт) і теж йому шось поміняти/переписати */
        $childColumnSet = $block->getChildBlock('grid.massaction');
//        $dataFromXMLChildBlock = $childColumnSet->getData('options');

        return $resultPage;
    }
}

//$resultPage = $this->resultPageFactory->create();
//$resultPage->initLayout(); // ?? vs getLayot()
//$this->_setActiveMenu($this->menuId);
//$resultPage->getConfig()->getTitle()->prepend(__('Bulk Actions Log')); //додати преф у поч масива. ТІПА текст??
//return $resultPage;
