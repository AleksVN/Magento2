<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Voloshkov\News\Block\Adminhtml\Forms\Edit;

//контейнер для форми + тулбар! за цю лише сторінку едіт? тіпа апдейт тулбара?  ? а тулбар-блок? за окремий?
use Magento\Backend\Block\Widget\ContainerInterface;

/**
 * Контейнер для форми + тулбар(оскільки батьківський клас імплементується від нужного інтерфейсу і має пуш - батона(не хліба, а button))
 *
 * ПРИМІТКА: Оскільки батьківський контейнер реалізований так як реалізовний то ми змушені створювати заодно і блок-клас форми. Путь до цього класу регулюється властивостями.
 * Див. @see \Magento\Backend\Block\Widget\Form\Container::_buildFormClassName
 */
class FormContainer extends \Magento\Backend\Block\Widget\Form\Container
{

    /**
     * Рефактор кода - ЛАЙК
     *
     * 1) властивості забрав з конструктора і поклав їх на законне місце - ЛАЙК
     * 2) переніс додавання кнопок у більш логічне місце. Але не треба забувати, що треба знати де пушаються кнопки - інакше не буде працювати(якщо, що можна пушнути самим)!!! - ЛАЙК
     * 3) Конструктор получилось, що пустий і його можна видалити взагалі(буде автоматично виконуватись батьківський)
     */


    /**
     * переписуємо батьківські властивості (на 15, 17, 19 строчці є значки що значать що ми переписуємо). Таким образом нам не треба це робити в конструкторі, бо то странно так переписувати у конструкторі)
     */
    /**
     * Ім'я параметру, який буде використвовуватись в уже створеному для нас методі
     * @see \Voloshkov\News\Block\Adminhtml\Forms\Edit\FormContainer::getDeleteUrl
     */
    protected $_objectId = 'news_id';

    /**
     * Властивості, по яким буде підбір путі до класу форми.
     * @see \Magento\Backend\Block\Widget\Form\Container::_buildFormClassName
     */
    protected $_controller = 'Adminhtml\Forms';
    protected $_blockGroup = 'Voloshkov_News';

    /* треба удалити */
    protected function _construct()
    {
        parent::_construct();
    }



    /**
     *
     * @see \Magento\Backend\Block\Widget\Container::_prepareLayout - тут пушається(цей клас є батьківський клас до нашого батька)
     *
     * @return \Voloshkov\News\Block\Adminhtml\Forms\Edit\FormContainer
     */
    protected function _prepareLayout()
    {
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
    }


    public function getGoogleUrl()
    {

        return $this->getUrl('http://google.com', [$this->_objectId => (int)$this->getRequest()->getParam($this->_objectId)]);

    }


}

