<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Voloshkov\News\Block\Adminhtml\Alllist\Edit\Tab;

use Magento\Framework\DataObject;

/**
 * Adminhtml permissions user edit form
 *
 * @SuppressWarnings(PHPMD.DepthOfInheritance)
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic
{
    public function __construct(

        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
    }


    /**
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Voloshkov\News\Api\Data\NewsDataInterface $dto */
        $dto = $this->getData('dto');
        $form = $this->_formFactory->create();

        $form->setUseContainer(true);
        $this->setForm($form);

        $baseFieldset = $form->addFieldset('base_fieldset', ['legend' => __('Account Information')]);


        $baseFieldset->addField(      'news_id',
            'hidden',
            [
                'name' => 'news_id',
                'value' => $dto->getId()

            ]);
            $baseFieldset->addField(      'title',
            'text',
            [
                'name' => 'title',
                'value' => $dto->getTitle(),
                'label' => __('Title'),
                'class' => 'required-entry',
                'required' => true
            ]);
//        $baseFieldset->addField(      'description',
//            'text',
//            [
//                'name' => 'description',
//                'value' => $dto->getDescription(),
//                'label' => __('description'),
//                'class' => 'required-entry',
//                'required' => true
//            ]);
//        $baseFieldset->addField(      'content',
//            'text',
//            [
//                'name' => 'content',
//                'value' => $dto->getContent(),
//                'label' => __('text'),
//                'class' => 'required-entry',
//                'required' => true
//            ]);
//        $baseFieldset->addField(      'is_top',
//            'text',
//            [
//                'name' => 'is_top',
//                'value' => $dto->getIsTop(),
//                'label' => __('is top'),
//                'class' => 'required-entry',
//                'required' => true
//            ]);
//
//

        return parent::_prepareForm();



    }




}

