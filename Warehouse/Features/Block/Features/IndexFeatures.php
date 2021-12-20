<?php

namespace Warehouse\Features\Block\Features;

use Magento\Catalog\Api\ProductRepositoryInterface;

class IndexFeatures extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Warehouse\Features\Model\FeaturesFactory
     */

    protected $featuresFactory;
    protected $_catalogFactory;
    protected $productRepository;
    protected $_coreRegistry;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Warehouse\Features\Model\FeaturesFactory        $featuresFactory,
        \Warehouse\Features\Model\CatalogFactory         $_catalogFactory,
        ProductRepositoryInterface                       $productRepository,
        \Magento\Catalog\Block\Product\Context           $productContext,
        array                                            $data = []
    )
    {
        $this->productRepository = $productRepository;
        $this->_catalogFactory = $_catalogFactory;
        $this->featuresFactory = $featuresFactory;
        $this->_coreRegistry = $productContext->getRegistry();
        $this->getProduct();
        parent::__construct($context, $data);
    }


    /**
     * Retrieve current product model
     *
     * @return \Magento\Catalog\Model\Product
     *
     * _coreRegistry extend from Catalog/Save and it checked product was registration?
     * if(ton_tai registry)-> ton tai product
     * else chua ton tai them moi
     */
    public function getProduct()
    {
        //var_dump($this->_coreRegistry->registry('product')->getData('sku')); die();
        return $this->_coreRegistry->registry('product')->getData('sku');
    }


    /**
     * @return \Magento\Framework\Data\Collection\AbstractDb|\Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection|null
     */
    protected function filterOrder($sku)
    {
        $this->sales_order_table = "main_table";
        $this->sales_order_payment_table = $this->getTable("catalog_product_entity");
        $this->getSelect()
            ->join(array('catalog_product_entity' => $this->sales_order_payment_table), $this->sales_order_table . '.entity_id= catalog_product_entity.parent_id',
                array('sku' => 'sku', 'entity_id' => $this->sales_order_table . '.entity_id'
                )
            );
        $this->getSelect()->where("sku = ?", $sku);
    }


    /**
     * @data
     */


    /**
     * @Array
     * join 2 table
     * set fillter follow sku
     */
    public function getPostCollection()
    {
        $sku = $this->getProduct();
        //var_dump('11111');die;
        //$maintable = 'maintable';
        $post = $this->featuresFactory->create();
        $collection = $post->getCollection();
        $collection->getSelect()->join(
            ["catalog_product_entity" => $collection->getTable("catalog_product_entity")],
            'main_table.entity_id = catalog_product_entity.entity_id',
            ['*']
        )->where("main_table.sku=?", "$sku");

        return $collection;
    }

    /**
     * @return \Magento\Framework\Data\Collection\AbstractDb|\Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection|null
     */
    public function getSKU()
    {
        $post = $this->_catalogFactory->create();
        return $post->getCollection();
    }

    /**
     * @return string
     */
    public function getNewUrl()
    {
        return $this->getUrl('anadin/features/newfeatures');
    }

    /**
     * @return string
     */
    public function getEditPageUrl()
    {
        return $this->getUrl('anadin/features/edit');
    }

    /**
     * @param $entity_id
     * @return string
     */
    public function getDeleteUrl($entity_id)
    {
        return $this->getUrl('anadin/features/delete', ['id' => $entity_id]);
    }

    /**
     * @return string
     */
    public function getIndexUrl()
    {
        return $this->getUrl('anadin/features/indexfeat');
    }

    /**
     * @return string
     */
    public function getPostUrl()
    {
        return $this->getUrl('anadin/features/save');
    }

    /**
     * @return string
     */
    public function getPostUrl1()
    {
        return $this->getUrl('anadin/features/save1');
    }

    /**
     * @return \Warehouse\Features\Model\Features
     */
    public function getAllData()
    {
        $id = $this->getRequest()->getParam("id");
        $model = $this->featuresFactory->create();
        return $model->load($id);
    }

    /**
     * @return string
     */
    public function getUpdate()
    {
        return $this->getUrl('anadin/features/update');
    }

}
