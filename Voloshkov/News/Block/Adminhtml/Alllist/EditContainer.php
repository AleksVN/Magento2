<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Voloshkov\News\Block\Adminhtml\Alllist;

use Magento\Backend\Block\Widget\ContainerInterface;


/**
 * container for content
 *
 */
class EditContainer extends \Magento\Backend\Block\Widget\Form\Container
//class Container extends \Magento\Framework\View\Element\Template //implements ContainerInterface
{
    /**
     * Ім'я параметру, який буде використвовуватись в уже створеному для нас методі
     * @see \Voloshkov\News\Block\Adminhtml\Forms\Edit\FormContainer::getDeleteUrl
     */
    protected $_objectId = 'news_id';

    /**
     * Властивості, по яким буде підбір путі до класу форми.
     * @see \Magento\Backend\Block\Widget\Form\Container::_buildFormClassName
     */
    protected $_controller = 'Adminhtml\Alllist';
    protected $_blockGroup = 'Voloshkov_News';

    /**
     *
     * @return \Voloshkov\News\Block\Adminhtml\Alllist\EditContainer
     *@see \Magento\Backend\Block\Widget\Container::_prepareLayout - тут пушається(цей клас є батьківський клас до нашого батька)
     *
     */
    protected function _prepareLayout()
    {
//        $this->addChild('form', '\Voloshkov\News\Block\Adminhtml\Alllist\Edit\Form');
        /** Ще одну полезну штучку случайном найшоу - ЛАЙК */
        $this->getLayout()->getBlock('page.title')->setPageTitle('News Create\Edit Page');


        /** push button робиться у батьківському класі - відповідно ми можемо у цьому методі теж додавати кнопки, а у конструкторі робити лиш супер важні вещі */
        // $this->buttonList->update('save', 'label', __('Save User'));
        //  $this->buttonList->update('delete', 'label', __('Save2 User'));

        $this->addButton('my', [
                'label' => __('My'),
                'onclick' => 'deleteConfirm(\'' . __(
                        'Are you sure?'
                    ) . '\', \'' . $this->getGoogleUrl() . '\', {data: {}})',
                'class' => 'delete',
                'sort_order' => 0
            ]
        );

        return parent::_prepareLayout();
        /**
         * @see \Magento\Framework\View\Element\AbstractBlock::addChild
         */
    }


    public function getGoogleUrl()
    {

        return $this->getUrl('http://google.com', [$this->_objectId => (int)$this->getRequest()->getParam($this->_objectId)]);

    }


}
