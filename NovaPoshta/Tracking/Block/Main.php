<?php
declare(strict_types=1);

namespace NovaPoshta\Tracking\Block;


use Magento\Framework\View\Element\Template;

class Main extends Template
{
    public function getFormUrl(): string
    {
        return $this->_urlBuilder->getUrl('novap/tracking');
    }
}
