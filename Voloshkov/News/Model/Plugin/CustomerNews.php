<?php

namespace Voloshkov\News\Model\Plugin;

use Magento\Authorization\Model\UserContextInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerExtensionInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Api\ExtensionAttributesFactory;
use Magento\Framework\App\Action\Context;
use Voloshkov\News\Api\Data\NewsDataInterface;
use Voloshkov\News\Model\ResourceModel\NewsResource\Collection;


class CustomerNews
{
    /** @var \Magento\Framework\Api\ExtensionAttributesFactory */
    private $extensionFactory;
    private $newsCollection;
//ідея по нашій задачі додати в модельку кастомера нашу модельку...


    public function __construct(ExtensionAttributesFactory $attributesFactory, Collection $collection)
    {
        $this->extensionFactory = $attributesFactory;
        $this->newsCollection = $collection;
    }

//Переписуємо after(внєдряємось у метод GetById ) а чому цей метод?
    public function afterGetById(
        CustomerRepositoryInterface $subject,
        \Magento\Customer\Api\Data\CustomerInterface $model, //прийняли модель кастомера. йо?
        $id
    ) //ЩО ЦЕ ? чом 2 змінна? кіть тут резулт має бути ? і шо то резултом має бути?
    {
        /**
         * У моделі з даними, до яких ми хочемо додати свої перевіряємо чи метод getExtensionAttributes повертає
         * об'єкт CustomerExtensionInterface (нажми на назву методу і там буде docBlock @return.)
         */
        $extensionAttributes = $model->getExtensionAttributes(); // отримуємо екс атрб (як видно з назви) для подальших зєднань атрибутів? Тіпа хтось ще міг написати розширені і нам треба їх перевірити, йо?
        if ($extensionAttributes === null) {
            /**
             *  Якщо ні(тобто якщо метод getExtensionAttributes повертає нулл, спочатку створюємо цей об'єкт) і сетаємо у модельку
             * через setExtensionAttributes. Цей об'єкт це така ж моделька, яка буде сидіти в модельці кастомера.


             * Створили через Factory знач моделька пуста.
             */
            /** @var CustomerExtensionInterface $extensionAttributes */

            $extensionAttributes = $this->extensionFactory->create(CustomerInterface::class);

            $model->setExtensionAttributes($extensionAttributes);
        }
        /**
         *  Витягуємо нашу колекцію і вставляємо у extensionAttributes.
         */
        $newsList = $this->newsCollection->addFilter(NewsDataInterface::NEWS_CUSTOMER_ID, $model->getId())->getItems();



        $extensionAttributes->setNewsListCustomerId($newsList);
        //->setNewsListCustomerId з ext.atribut.xml <attribute code="news_list_customer_id"
        //цей уторений метод додає нашу колекцію у модельку кастомера. йо?
        return $model;
    }
}
