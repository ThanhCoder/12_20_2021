<?php
namespace Warehouse\Features\Model\ResourceModel\Catalog;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'warehouse_features_catalog_collection';
    protected $_eventObject = 'catalog_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Warehouse\Features\Model\Catalog', 'Warehouse\Features\Model\ResourceModel\Catalog');
    }
}
