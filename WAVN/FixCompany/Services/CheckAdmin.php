<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace WAVN\FixCompany\Services;


use Magento\User\Api\Data\UserInterface;
use Magento\User\Model\ResourceModel\User\CollectionFactory;

class CheckAdmin implements \Magento\Framework\Option\ArrayInterface
{

    /**
     * @var \Magento\User\Model\ResourceModel\User\Collection
     */
    private $collection;

    public function __construct(
        CollectionFactory $companyCollectionFactory
    ) {
        $this->collection = $companyCollectionFactory->create();
    }

    public function toOptionArray()
    {
        $items = $this->collection->getItems();
        $options = [];
        /** @var UserInterface $adminUser */
        foreach ($items as $adminUser) {
            $options[] = ['label' => $adminUser->getUserName(), 'value' => $adminUser->getId()];
        }
        return $options;
    }


//    /**
//     * Options getter
//     *
//     * @return array
//     */
//    public function toOptionArray()
//    {
//        return [['value' => 1, 'label' => __('Yes')], ['value' => 0, 'label' => __('No')], ['value' => 2, 'label' => __('Kakashka')]];
//    }
//
//    /**
//     * Get options in "key-value" format
//     *
//     * @return array
//     */
//    public function toArray()
//    {
//        return [0 => __('No'), 1 => __('Yes')];
//    }
}
