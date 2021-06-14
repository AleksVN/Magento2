<?php


namespace Voloshkov\News\Block;


use Magento\Framework\View\Element\Template;

class NewsCategory extends \Magento\Framework\View\Element\Template
{

    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
// ne dobre
//        $objPrepar = $this->getData('obj_prepare');
//        $newsCollection = $objPrepar->getNewsItems();

//        return $newsCollection;

//        foreach ($newsCollection as $news) {
//            $test = $news->getData('title');
//        }

    }
}
