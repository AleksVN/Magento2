<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Voloshkov\News\Block\Adminhtml\Forms\Edit;

/**
 * Adminhtml permissions user edit form
 *
 * @SuppressWarnings(PHPMD.DepthOfInheritance)
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @return $this
     */
    protected function _prepareForm()
    {

        /** @var \Voloshkov\News\Api\Data\NewsDataInterface $dto */
        $dto = $this->getData('dto');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );
        $form->setUseContainer(true);

        $baseFieldset = $form->addFieldset('base_fieldset', ['legend' => __('Account Information')]);

        $baseFieldset->addField(      'news_id',
            'hidden',
            [
                'name' => 'news_id',
                'value' => $dto->getId(),

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
        $baseFieldset->addField(      'description',
            'text',
            [
                'name' => 'description',
                'value' => $dto->getDescription(),
                'label' => __('description'),
                'class' => 'required-entry',
                'required' => true
            ]);
        $baseFieldset->addField(      'content',
            'text',
            [
                'name' => 'content',
                'value' => $dto->getContent(),
                'label' => __('text'),
                'class' => 'required-entry',
                'required' => true
            ]);
        $baseFieldset->addField(      'is_top',
            'text',
            [
                'name' => 'is_top',
                'value' => $dto->getIsTop(),
                'label' => __('is top'),
                'class' => 'required-entry',
                'required' => true
            ]);


        $this->setForm($form);
        return parent::_prepareForm();



    }




}

