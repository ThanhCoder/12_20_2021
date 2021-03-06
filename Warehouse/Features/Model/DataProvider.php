<?php

namespace Warehouse\Features\Model;

use Warehouse\Features\Model\ResourceModel\Features\CollectionFactory;

//use Warehouse\Features\Model\ResourceModel\Warehouse\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $employeeCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $employeeCollectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $employeeCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * NOTICE: getData set Edit Features
     *
     * @return array
     */
    public function getData()
    {

        if (isset($this->loadedData)) {

            return $this->loadedData;

        }

        $items = $this->collection->getItems();

        foreach ($items as $item) {

            $this->loadedData[$item->getId()] = $item->getData();

        }

        return $this->loadedData;

    }
}

