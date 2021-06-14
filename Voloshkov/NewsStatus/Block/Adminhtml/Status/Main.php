<?php


namespace Voloshkov\NewsStatus\Block\Adminhtml\Status;


class Main extends \Magento\Backend\Block\Template
{
    const LIST_MODE = 'list';

    const GRID_MODE = 'grid';

    protected $_template = 'Voloshkov_NewsStatus::status/main.phtml';

    protected function _beforeToHtml()
    {
        if ($this->getData('mode') === null) {
            throw new \LogicException(__('mode required!'));
        }
        return parent::_beforeToHtml();
    }

}
