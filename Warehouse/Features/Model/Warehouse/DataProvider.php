<?php
namespace Warehouse\Features\Model\Warehouse;

use Warehouse\Features\Model\ResourceModel\Warehouse\CollectionFactory;

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
    ) {
        $this->collection = $employeeCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
 
    /**
     * Get data
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

    public function toOptionArray()
    {
        //$post = $this->warehouseFactory->create();
        $collections = $this->collection->getCollection();
        // $collections = $collection->getSelect()->joinRight(
        //     ["catalog_product_entity" => $collection->getTable("catalog_product_entity")],
        //     'main_table.entity_id = catalog_product_entity.entity_id',
        //     ['*']
        // );
        // var_dump($collections->__toString());
        // die();
        $collections->getSelect()->joinRight(
                ["catalog_product_entity" => $collections->getTable("catalog_product_entity")],
                'main_table.entity_id = catalog_product_entity.entity_id',
                ['*']
            );

        $configOptions = $collections;
        //$configOptions = $this->pageLayoutBuilder->getPageLayoutsConfig()->getOptions();
        $options = [];
        foreach ($configOptions as $key => $value) {
            // var_dump($value);
            // die();
            $options[] = [
                'label' => $value->getSku(),
                'value' => $value->getSku(),
            ];
        }
        $this->options = $options;

        
        return $options;
    }

}    


