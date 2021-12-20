<?php

namespace Warehouse\Features\Block\Features;


class Index extends \Magento\Framework\View\Element\Template
{

    protected $_catalogFactory;
    protected $featuresFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Warehouse\Features\Model\FeaturesFactory        $featuresFactory,
        \Warehouse\Features\Model\CatalogFactory         $_catalogFactory,
        array                                            $data = []
    )
    {
        $this->featuresFactory = $featuresFactory;
        $this->_catalogFactory = $_catalogFactory;
        parent::__construct($context, $data);
    }

    /**
     * @param getPostCollection()
     */
    public function getPostCollection()
    {
        $post = $this->featuresFactory->create();
        return $post->getCollection();
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

