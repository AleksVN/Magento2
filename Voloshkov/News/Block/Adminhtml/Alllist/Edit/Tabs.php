<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Voloshkov\News\Block\Adminhtml\Alllist\Edit;

use Magento\Framework\App\ObjectManager;

/**
 * User page left menu
 *
 * @api
 * @author      Magento Core Team <core@magentocommerce.com>
 * @since 100.0.2
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    private $tabs = [];
    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('page_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('User Information'));
    }

    protected function _prepareLayout()
    {
        $this->tabs['test_block'] = $this->addChild('test_block', \Voloshkov\News\Block\Adminhtml\Alllist\Edit\Tab\Main::class);
        $this->tabs['test_block2'] = $this->addChild('test_block2', \Voloshkov\News\Block\Adminhtml\Alllist\Edit\Tab\Roles::class);

        return parent::_prepareLayout();
    }

    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'main_section',
            [
                'label' => __('User Info'),
                'title' => __('User Info'),
                'content' => $this->tabs['test_block']->toHtml(),
                'active' => true
            ]
        );

        $this->addTab(
            'roles_section',
            [
                'label' => __('User Role'),
                'title' => __('User Role'),
                'content' => $this->tabs['test_block2']->toHtml(),
            ]
        );
        return parent::_beforeToHtml();
    }
}
