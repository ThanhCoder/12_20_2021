<?php

namespace Warehouse\Features\Controller\Warehouse;

use Warehouse\Features\Model\Warehouse;
use Warehouse\Features\Model\ResourceModel\Warehouse as WarehouseResourceModel;

class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;


    private $_warehouse;
    /**
     */
    private $_warehouseResourceModel;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context      $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        Warehouse                                  $warehouse,
        WarehouseResourceModel                     $warehouseResourceModel
    )
    {
        $this->_warehouse = $warehouse;
        $this->_warehouseResourceModel = $warehouseResourceModel;
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
            // Get Prams
        $params = $this->getRequest()->getParams();
        //$id = $data['entity_id'] ?? null;
        //if ($params) {
        //  $model->load($id);
        //}
        $ware = $this->_warehouse->setData($params);//TODO: Challenge Modify here to support the edit save functionality
        try {

            $this->_warehouseResourceModel->save($ware);
            $this->messageManager->addSuccessMessage(__("Successfully added the Products %1", $params['sku']));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Something went wrong."));
        }
        /* Redirect back to hero display page */
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('anadin/warehouse/index');
        return $redirect;
    }
}
