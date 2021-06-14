<?php

namespace Voloshkov\News\Controller\Mylist;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\DataObject;

/**
 * Create or edit one item
 */
class Edit extends Action
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;
    /**
     * @var \Voloshkov\Services\VerifyChek
     */
    private $verifyChek;
    /**
     * @var \Voloshkov\News\Model\ResourceModel\NewsRepository
     */
    private $newsRepository;
    /**
     * @var \Magento\Catalog\Model\CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category\Collection
     */
    private $collectionCategory;
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category
     */
    private $resourseCategory;

    /**
     * @var \Magento\Catalog\Model\CategoryFactory
     */
    private $catalogModelCategory;

    public function __construct(
        Context $context,
        \Voloshkov\Services\VerifyChek $verifyChek,
        \Magento\Customer\Model\Session $customerSession,
        \Voloshkov\News\Model\ResourceModel\NewsRepository $newsRepository,
        \Magento\Catalog\Model\CategoryRepository $categoryRepository,
        \Magento\Catalog\Model\ResourceModel\Category\Collection $collectionCategory,
        \Magento\Catalog\Model\ResourceModel\Category $resourseCategory,
        \Magento\Catalog\Model\CategoryFactory $catalogModelCategory
    ) {
        parent::__construct($context);
        $this->verifyChek = $verifyChek;
        $this->customerSession = $customerSession;
        $this->newsRepository = $newsRepository;
        $this->categoryRepository = $categoryRepository;
        $this->collectionCategory = $collectionCategory;
        $this->resourseCategory = $resourseCategory;
        $this->catalogModelCategory = $catalogModelCategory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        if ($this->verifyChek->checkUsersType()) {
            if ($id === null || $this->verifyChek->VerifyOwn((int)$id)) {
                $dto = $this->newsRepository->getById((int)$id);
                $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
                $block = $resultPage->getLayout()->getBlock('edit_add');
                $block->setData('dto', $dto);
////////////////
                $allNamesCategory = [];
              $categoryIds = $this->collectionCategory->getAllIds();
              foreach ($categoryIds as $categoryId){
                 // $object = new DataObject();
//                  $object->setEntityId($categoryId);
// якщо користуємось ресурсною моделлю то шидше бо
                  $model = $this->catalogModelCategory->create();
//                  $object->setId($categoryId);
                  //$objWithDataWithName =
                      $this->resourseCategory->load($model, $categoryId, ['name']);
//якщо репозіторій то
                   $categories =  $this->categoryRepository->get($categoryId);

                 $allNamesCategory[] = ['name' => $model->getName(), 'id' => $model->getId()];
                 //  array_push($allNamesCategory, $categories->getName());
               }
                $result =  $block->setData('catData', $allNamesCategory);


                return $resultPage;
            }
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $this->messageManager->addErrorMessage(__('Edit: not found'));

        return $resultRedirect->setPath("news/mylist/all");
    }
}
