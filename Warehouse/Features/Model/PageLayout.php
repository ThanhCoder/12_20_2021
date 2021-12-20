<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Warehouse\Features\Model;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\View\Model\PageLayout\Config\BuilderInterface;
use \Warehouse\Features\Model\WarehouseFactory;
use \Warehouse\Features\Model\Warehouse\DataProvider;

/**
 * Class PageLayout
 */
class PageLayout extends DataProvider implements OptionSourceInterface 
{
    /**
     * @var \Magento\Framework\View\Model\PageLayout\Config\BuilderInterface
     */
    protected $pageLayoutBuilder;


    protected $warehouseFactory;
    /**
     * @var array
     * @deprecated 103.0.1 since the cache is now handled by \Magento\Theme\Model\PageLayout\Config\Builder::$configFiles
     */
    protected $options;

    /**
     * Constructor
     *
     * @param BuilderInterface $pageLayoutBuilder
     */
    public function __construct(BuilderInterface $pageLayoutBuilder,WarehouseFactory $warehouseFactory)
    {
        $this->warehouseFactory = $warehouseFactory;
        $this->pageLayoutBuilder = $pageLayoutBuilder;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $post = $this->warehouseFactory->create();
        $collection = $post->getCollection();
        // $collections = $collection->getSelect()->joinRight(
        //     ["catalog_product_entity" => $collection->getTable("catalog_product_entity")],
        //     'main_table.entity_id = catalog_product_entity.entity_id',
        //     ['*']
        // );
        // var_dump($collections->__toString());
        // die();
        $collection->getSelect()->joinRight(
                ["catalog_product_entity" => $collection->getTable("catalog_product_entity")],
                'main_table.entity_id = catalog_product_entity.entity_id',
                ['*']
            );

        $configOptions = $collection;
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
