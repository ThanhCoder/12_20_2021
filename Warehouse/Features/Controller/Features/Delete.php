<?php

namespace Warehouse\Features\Controller\Features;

class Delete extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;
    protected $_request;
    protected $_featureshouseFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context      $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\App\Request\Http        $request,
        \Warehouse\Features\Model\FeaturesFactory  $featureshouseFactory
    )
    {
        $this->_featureshouseFactory = $featureshouseFactory;
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
        $entity_id = $this->_request->getParam('id');
        $postData = $this->_featureshouseFactory->create()->load($entity_id);
        // var_dump($id);
        // die();
        $postData->delete();
        return $this->_redirect('anadin/features/indexfeat');
    }
}
