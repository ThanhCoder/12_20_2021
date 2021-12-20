<?php

namespace Warehouse\Features\Controller\Adminhtml\Warehouse;

use Warehouse\Features\Model\Features as Features;


class Delete extends \Magento\Backend\App\Action
{
    /**
     * @AllureId
     */
    const ADMIN_RESOURCE = 'Delete';
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Warehouse\Features\Model\WarehouseFactory
     */
    protected $warehouseFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context        $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Warehouse\Features\Model\WarehouseFactory $warehouseFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->warehouseFactory = $warehouseFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $warehouse = $this->warehouseFactory->create()->load($id);

        if (!$warehouse) {
            $this->messageManager->addError(__('Unable to process. please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/', array('_current' => true));
        }

        try {
            $warehouse->delete();
            $this->messageManager->addSuccess(__('Your features has been deleted !'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__('Error while trying to delete features'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}
