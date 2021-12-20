<?php
namespace Warehouse\Features\Model\ResourceModel\Warehouse;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'warehouse_features_warehouse_collection';
    protected $_eventObject = 'warehouse_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Warehouse\Features\Model\Warehouse', 'Warehouse\Features\Model\ResourceModel\Warehouse');
    }
}
