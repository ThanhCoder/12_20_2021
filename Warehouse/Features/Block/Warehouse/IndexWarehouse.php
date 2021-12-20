<?php

namespace Warehouse\Features\Block\Warehouse;

use Magento\Catalog\Api\ProductRepositoryInterface;

class IndexWarehouse extends \Magento\Framework\View\Element\Template

    /**
     * Xet 2 cach
     * Cach 1: Extend Product/View va lay ham
     * \Magento\Catalog\Block\Product\View
     * Cach 2:
     */

{
    /**
     * @var \Warehouse\Features\Model\FeaturesFactory
     */
    protected $warehouseFactory;
    protected $_catalogFactory;
    protected $productRepository;
    protected $_coreRegistry;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Warehouse\Features\Model\WarehouseFactory       $warehouseFactory,
        \Warehouse\Features\Model\CatalogFactory         $_catalogFactory,
        ProductRepositoryInterface                       $productRepository,
        \Magento\Catalog\Block\Product\Context           $productContext,
        array                                            $data = []
    )
    {
        $this->productRepository = $productRepository;
        $this->_catalogFactory = $_catalogFactory;
        $this->warehouseFactory = $warehouseFactory;
        $this->_coreRegistry = $productContext->getRegistry();
        $this->getProduct();
        parent::__construct($context, $data);
    }


    /**
     * Retrieve current product model
     *
     * @return \Magento\Catalog\Model\Product
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
     * @Array
     */
    public function getPostCollection()
    {
        $sku = $this->getProduct();
        //var_dump('11111');die;
        //$maintable = 'maintable';
        $post = $this->warehouseFactory->create();
        $collection = $post->getCollection();

        $collection->getSelect()->where("main_table.sku=?", "$sku");

        return $collection;
    }

    /**
     * @param getSKU()
     */
    public function getSKU()
    {
        $post = $this->_catalogFactory->create();
        return $post->getCollection();
    }

    /**
     * @param getNewUrl()
     */
    public function getNewUrl()
    {
        return $this->getUrl('anadin/warehouse/newwarehouse');
    }

    /**
     * @param getEditPageUrl()
     */
    public function getEditPageUrl()
    {
        return $this->getUrl('anadin/warehouse/edit');
    }

    /**
     * @param getDeleteUrl()
     */
    public function getDeleteUrl($entity_id)
    {
        return $this->getUrl('anadin/warehouse/delete', ['id' => $entity_id]);
    }

    /**
     * @param getIndexUrl()
     */
    public function getIndexUrl()
    {
        return $this->getUrl('anadin/warehouse/index');
    }

    /**
     * @param getPostUrl()
     */
    public function getPostUrl()
    {
        return $this->getUrl('anadin/warehouse/save');
    }

    /**
     * @param getPostUrl1()
     */
    public function getPostUrl1()
    {
        return $this->getUrl('anadin/warehouse/save1');
    }

    /**
     * @param getUpdate()
     */
    public function getUpdate()
    {
        return $this->getUrl('anadin/warehouse/update');
    }

    /**
     * @param getAllData()
     */
    public function getAllData()
    {
        $id = $this->getRequest()->getParam("id");
        $model = $this->_warehouseFactory->create();
        return $model->load($id);
    }

}
