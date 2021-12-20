<?php
namespace Warehouse\Features\Model\ResourceModel\Features;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'warehouse_features_features_collection';
    protected $_eventObject = 'features_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Warehouse\Features\Model\Features', 'Warehouse\Features\Model\ResourceModel\Features');
    }
}
