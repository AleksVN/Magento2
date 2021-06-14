<?php

namespace Voloshkov\News\Model\ResourceModel;

/**
 * Repository
 */
class NewsRepository implements \Voloshkov\News\Api\NewsRepositoryInterface
{
    /**
     * @var \Voloshkov\News\Model\NewsModelFactory
     */
    private $factoryDto;
    private $resourceNews;

    public function __construct(
        NewsResource $newsResource,
        \Voloshkov\News\Model\Data\NewsDataFactory $dtoFactory
    ) {
        $this->resourceNews = $newsResource;
        $this->factoryDto = $dtoFactory;
    }
    /**
     * @inheritDoc
     */
    public function getById(int $id): \Voloshkov\News\Api\Data\NewsDataInterface
    {
        $newsData = $this->factoryDto->create();
        $this->resourceNews->load($newsData, $id);
        return $newsData;
    }

    /**
     * @inheritDoc
     */
    public function save(\Voloshkov\News\Api\Data\NewsDataInterface $newsData): \Voloshkov\News\Api\Data\NewsDataInterface
    {
     $this->resourceNews->save($newsData);
     return $newsData;

    }

    /**s
     * @inheritDoc
     */
    public function deleteById(int $id): bool
    {
        $newsData = $this->factoryDto->create();
        $this->resourceNews->load($newsData, $id);
        try {
            $this->resourceNews->delete($newsData);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}
