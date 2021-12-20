<?php

namespace Warehouse\Features\Controller\Warehouse;

class Delete extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;
    protected $_request;
    protected $_warehouseFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context      $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\App\Request\Http        $request,
        \Warehouse\Features\Model\WarehouseFactory $warehouseFactory
    )
    {
        $this->_warehouseFactory = $warehouseFactory;
        $this->_request = $request;
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // Get Prams id in URL
        $entity_id = $this->_request->getParam('id');
        $postData = $this->_warehouseFactory->create()->load($entity_id);
        // var_dump($id);
        // die();
        $postData->delete();
        return $this->_redirect('anadin/warehouse/index');
    }
}
