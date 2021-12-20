<?php

namespace Warehouse\Features\Controller\Features;

use Warehouse\Features\Model\Features;
use Warehouse\Features\Model\ResourceModel\Features as FeaturesResourceModel;

class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;


    private $_features;
    /**
     */
    private $_featuresResourceModel;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context      $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        Features                                   $features,
        FeaturesResourceModel                      $featuresResourceModel
    )
    {
        $this->_features = $features;
        $this->_featuresResourceModel = $featuresResourceModel;
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
        /**Get Request Send, Get Params */
        $params = $this->getRequest()->getParams();
        $feature = $this->_features->setData($params);//TODO: Challenge Modify here to support the edit save functionality
        try {
            $this->_featuresResourceModel->save($feature);
            $this->messageManager->addSuccessMessage(__("Successfully added the Features %1", $params['sku']));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Something went wrong."));
        }
        /* Redirect back to features display page */
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('anadin/features/indexfeat');
        return $redirect;
    }
}
