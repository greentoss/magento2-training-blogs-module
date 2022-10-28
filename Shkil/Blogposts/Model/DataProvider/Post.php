<?php

namespace Shkil\Blogposts\Model\DataProvider;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Shkil\Blogposts\Model\ResourceModel\Post\CollectionFactory;

class Post extends AbstractDataProvider
{
    protected $collection;

    protected StoreManagerInterface $storeManager;

    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData(): array
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $item) {
            $this->loadedData[$item->getData('post_id')] = $item->getData();
        }

        return $this->loadedData;
    }
}
