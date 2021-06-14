<?php
namespace Voloshkov\News\Block;


use Magento\Framework\Controller\ResultFactory;

/**
 * Return the CRUD Url.
 *
 * @return string
 */
class BlockUrl extends \Magento\Framework\View\Element\Template
{
    public function getSaveUrl()
    {
        return $this->_urlBuilder->getUrl(
            'news/mylist/save',
            []
        );
    }

    public function getEditUrl()
    {
        /** @var \Voloshkov\News\Model\NewsModel $model */
     $model = $this->getData('dto');

        return $this->_urlBuilder->getUrl(
            'news/mylist/edit',
            ['id' => $model->getId()]
        );
    }

    public function getViewUrl($id)
    {
        return $this->_urlBuilder->getUrl(
            'news/mylist/viewone',
            ['id' => $id]
        );
    }

        public function getDeleteUrl($id)
    {
        return $this->_urlBuilder->getUrl(
            'news/mylist/delete',
            ['id' => $id]
        );
    }
}

