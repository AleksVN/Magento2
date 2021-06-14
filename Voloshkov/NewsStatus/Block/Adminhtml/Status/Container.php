<?php


namespace Voloshkov\NewsStatus\Block\Adminhtml\Status;


class Container extends \Magento\Backend\Block\Template
{
    protected $_template = 'Voloshkov_NewsStatus::status/container.phtml';

    /**
     * @var bool
     */
    private $needChild;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        array $data = []
    ) {
        if (isset($data['htmlId']) && $data['htmlId'] === '') {
            throw new \InvalidArgumentException(__('HtmlId required'));
        }
        $this->needChild = $data['needChild'] ?? false;
        parent::__construct($context, $data);
    }


    protected function _prepareLayout()
    {
        if ($this->needChild) {
            $this->addChild('status.main', \Voloshkov\NewsStatus\Block\Adminhtml\Status\Main::class);
        } else {
            $block = $this->getChildBlock('status.main');
            if (!$block) {
                throw new \LogicException(__('Set "needChild" to true or add custom Block in XML!!!'));
            }
        }
        return parent::_prepareLayout();
    }

}
