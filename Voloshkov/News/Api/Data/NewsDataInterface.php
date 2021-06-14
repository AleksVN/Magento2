<?php

namespace Voloshkov\News\Api\Data;

/**
 * Model with data
 */
interface NewsDataInterface
{
    const ID = 'news_id';
    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const CONTENT = 'content';
    const IS_TOP = 'is_top';
    const ADMIN_ID = 'admin_id';
    const NEWS_CUSTOMER_ID = 'news_customer_id';
//    const NEWS_CUSTOMER_ID = 'admin_id';
    const UPDATED_AT = 'updated_at';
    const  CATEGORY_NEWS = 'category_news';

    /**
     * @return int
     */
    public function getId(): ?int;

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id): ?self;

    /**
     * @return string
     */
    public function getTitle(): ?string;

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self;

    /**
     * @return string
     */
    public function getDescription(): ?string;

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self;

    /**
     * @return string
     */
    public function getContent(): ?string;

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): self;

    /**
     * @return bool
     */
    public function getIsTop(): ?bool;

    /**
     * @param bool $isTop
     * @return $this
     */
    public function setIsTop(bool $isTop): self;

    /**
     * @return int
     */
    public function getAdminId(): int;

    /**
     * @param int $adminId
     * @return $this
     */
    public function setAdminId(int $adminId): self;

    /**
     * @return int
     */
    public function getNewsCustomerId();

    /**
     * @param int $customerId
     * @return $this
     */
    public function setNewsCustomerId(?int $customerId): self;

    /**
     * @return string
     */
    public function getUpdatedAt(): ?string;

    /**
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt(string $updatedAt): self;

    /**
     * @param string $categoryNews
     * @return mixed
     */
    public function setCategoryNews (string $categoryNews);
}
