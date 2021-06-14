<?php


namespace Voloshkov\News\ViewModel;


class PrepareNewsCategory implements \Magento\Framework\View\Element\Block\ArgumentInterface
{


    /**
     * @var \Voloshkov\News\Model\ResourceModel\NewsResource\Collection
     */
    private $newsCollection;
    /**
     * @var \Magento\Catalog\Model\Layer
     */
    private $modelLayer;

    public function __construct(
        \Voloshkov\News\Model\ResourceModel\NewsResource\Collection $collection,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver)
    {
        $this->newsCollection = $collection;
        $this->modelLayer = $layerResolver->get();
    }

    public function getNewsItems()
    {
        $categoryId = (string)$this->modelLayer->getCurrentCategory()->getId();
        return $this->newsCollection->addFilter('category_news', $categoryId)->getItems();
    }


}
