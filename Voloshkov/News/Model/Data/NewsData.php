<?php


namespace Voloshkov\News\Model\Data;

class NewsData extends \Magento\Framework\Model\AbstractModel implements \Voloshkov\News\Api\Data\NewsDataInterface
{
    protected function _construct()
    {
        $this->_init(\Voloshkov\News\Model\ResourceModel\NewsResource::class);
    }

    /**
     * @inheritDoc
     */
    public function getId(): ?int
    {
        return $this->getData(self::ID);

    }

    /**
     * @inheritDoc
     */
    public function setId($id): \Voloshkov\News\Api\Data\NewsDataInterface
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @inheritDoc
     */
    public function getTitle(): ?string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function setTitle(string $title): \Voloshkov\News\Api\Data\NewsDataInterface
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): ?string
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * @inheritDoc
     */
    public function setDescription(string $description): \Voloshkov\News\Api\Data\NewsDataInterface
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @inheritDoc
     */
    public function getContent(): ?string
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @inheritDoc
     */
    public function setContent(string $content): \Voloshkov\News\Api\Data\NewsDataInterface
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * @inheritDoc
     */
    public function getIsTop(): ?bool
    {
        return $this->getData(self::IS_TOP);
    }

    /**
     * @inheritDoc
     */
    public function setIsTop(bool $isTop): \Voloshkov\News\Api\Data\NewsDataInterface
    {
        return $this->setData(self::IS_TOP, $isTop);
    }

    /**
     * @inheritDoc
     */
    public function getAdminId(): int
    {
        return $this->getData(self::ADMIN_ID);
    }

    /**
     * @inheritDoc
     */
    public function setAdminId(int $adminId): \Voloshkov\News\Api\Data\NewsDataInterface
    {
        return $this->setData(self::ADMIN_ID, $adminId);
    }

    /**
     * @inheritDoc
     */
    public function getNewsCustomerId()
    {
        return $this->getData(self::NEWS_CUSTOMER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setNewsCustomerId(?int $customerId): \Voloshkov\News\Api\Data\NewsDataInterface
    {
        return $this->setData(self::NEWS_CUSTOMER_ID, $customerId);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt(string $updatedAt): \Voloshkov\News\Api\Data\NewsDataInterface
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    public function setCategoryNews(string $categoryNews)
    {
        return $this->setData(self::CATEGORY_NEWS, $categoryNews);
    }
}
