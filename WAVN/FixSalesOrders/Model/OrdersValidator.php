<?php


namespace WAVN\FixSalesOrders\Model;


use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;

class OrdersValidator
{
    /**
     * @var \Magento\Sales\Api\OrderRepositoryInterface
     */
    private $orderRepository;

    private $arrAdress = ['city' => 'Muk', 'street' => 'Borok Telep 21', 'countre' => 'Ukraine'];
    /**
     * @var \Magento\Sales\Api\OrderAddressRepositoryInterface
     */
    private $addressRepository;
    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\Address
     */
    private $addressResource;
    /**
     * @var \Magento\Sales\Model\Order\AddressFactory
     */
    private $modelAdress;
    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\Address\Collection
     */
    private $collAddress;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaInterfaceFactory
     */
    private $criteriaFactory;
    /**
     * @var \Magento\Framework\Api\FilterBuilder
     */
    private $filterBuilder;
    private $filterGroupBuilder;

    public function __construct(
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        \Magento\Sales\Api\OrderAddressRepositoryInterface $addressRepository,
        \Magento\Sales\Model\ResourceModel\Order\Address $addressResource,
        \Magento\Sales\Model\ResourceModel\Order\Address\Collection $collAddress,
        \Magento\Sales\Model\Order\AddressFactory $modelAdress,
        \Magento\Framework\Api\SearchCriteriaInterfaceFactory $criteriaFactory,
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder
    ) {
        $this->orderRepository = $orderRepository;
        $this->addressRepository = $addressRepository;
        $this->criteriaFactory = $criteriaFactory;
        $this->addressResource = $addressResource;
        $this->modelAdress = $modelAdress;
        $this->collAddress = $collAddress;
        $this->filterBuilder = $filterBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;

    }

    public function execute()
    {

        $collOrders = $this->orderRepository->getList($this->criteriaFactory->create());


        $arr = [];
        foreach ($collOrders->getItems() as $model) {
            if (100 < $model->getGrandTotal()) {
                $arr[] = $model->getId();


            }
        }
//            $this->collAddress->addFilter('address_type', 'shipping')->addFieldToFilter('parent_id', ['in' => $arr]);
//            $this->collAddress->getItems();

        $shipingFilter = $this->filterBuilder
            ->setField('address_type')
            ->setValue('shipping')
            ->create();

        $parentIdFilter = $this->filterBuilder
            ->setField('parent_id')
            ->setValue($arr)
            ->setConditionType('in')
            ->create();

        $shippingGroup = $this->filterGroupBuilder->addFilter($shipingFilter)->create();
        $parentIdGroup = $this->filterGroupBuilder->addFilter($parentIdFilter)->create();


        $criteria = $this->criteriaFactory->create()->setFilterGroups([$shippingGroup, $parentIdGroup]);


        $collOrdersAddress = $this->addressRepository->getList($criteria);
          $a = $collOrdersAddress->getItems();
$test = 0;
//LIKE
        //  $this->addressResource->load($this->modelAdress->create(),  );


    }


}
