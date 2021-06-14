<?php


namespace Voloshkov\News\Api;

/**
 * CRUD
 */
interface NewsRepositoryInterface
{

    /**
     *
     * @param int $id
     * @return \Voloshkov\News\Api\Data\NewsDataInterface
     */
    public function getById(int $id): \Voloshkov\News\Api\Data\NewsDataInterface;

    /**
     *
     * @param \Voloshkov\News\Api\Data\NewsDataInterface $newsData
     * @return \Voloshkov\News\Api\Data\NewsDataInterface
     */
    public function save(\Voloshkov\News\Api\Data\NewsDataInterface $newsData
    ): \Voloshkov\News\Api\Data\NewsDataInterface;

    /**
     *
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;
}
