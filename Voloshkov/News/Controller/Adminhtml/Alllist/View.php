<?php


namespace Voloshkov\News\Controller\Adminhtml\Alllist;


use Magento\Backend\App\AbstractAction;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class View extends Action
{
    public const ADMIN_RESOURCE = 'Voloshkov_News::index';


    public function execute()
    {
        $fignya = 'dadsda';



        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $block = $resultPage->getLayout()->getBlock('admin_all_block');

        $block->setData('br', $fignya);



        return $resultPage;
    }

//    protected function _isAllowed()
//    {
//        return $this->_authorization->isAllowed('Voloshkov_News::index');
//    }
}
