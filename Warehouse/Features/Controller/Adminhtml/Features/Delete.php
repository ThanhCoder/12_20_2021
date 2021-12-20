<?php

namespace Warehouse\Features\Controller\Adminhtml\Features;

use Warehouse\Features\Model\Features as Features;

/**
 * @Access
 * @Delete
 */
class Delete extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Delete';

    protected $resultPageFactory;
    protected $featuresFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context        $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Warehouse\Features\Model\FeaturesFactory  $featuresFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->featuresFactory = $featuresFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $features = $this->featuresFactory->create()->load($id);

        if (!$features) {
            $this->messageManager->addError(__('Unable to process. please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/', array('_current' => true));
        }

        try {
            $features->delete();
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
