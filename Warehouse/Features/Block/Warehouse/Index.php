<?php

namespace Warehouse\Features\Block\Warehouse;


class Index extends \Magento\Framework\View\Element\Template
{

    protected $_warehouseFactory;
    protected $_catalogFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Warehouse\Features\Model\WarehouseFactory       $_warehouseFactory,
        \Warehouse\Features\Model\CatalogFactory         $_catalogFactory,
        array                                            $data = []
    )
    {
        $this->_warehouseFactory = $_warehouseFactory;
        $this->_catalogFactory = $_catalogFactory;
        parent::__construct($context, $data);
    }

    /**
     * @param getPostCollection()
     */
    public function getPostCollection()
    {
        $post = $this->_warehouseFactory->create();
        return $post->getCollection();
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
