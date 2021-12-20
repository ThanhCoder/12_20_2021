<?php

namespace Warehouse\Features\Controller\Adminhtml\Features;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Warehouse\Features\Model\FeaturesFactory
     */
    protected $featuresFactory;

    /**
     * @var
     */
    protected $resultPageFactory;


    public function __construct(
        \Magento\Backend\App\Action\Context        $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Warehouse\Features\Model\FeaturesFactory  $featuresFactory

    )
    {

        parent::__construct($context);

        $this->featuresFactory = $featuresFactory;

    }

    public function execute()
    {
        // Lay duong dan tren URL se lay cai id
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data)
            try {
                // set id theo cot banner_id
                $id = $data['entity_id'] ?? null;
                // lay du lieu tu cot banner_id bang load(id)
                $model = $this->featuresFactory->create();

                if ($id) {
                    $model->load($id);
                }

                $model->addData([
                    "sku" => $data['sku'],
                    "features" => $data['features'],
                    "benefit" => $data['benefit']
                ]);

                $saveData = $model->save();

                if ($saveData) {
                    $this->messageManager->addSuccess(__('Insert data Successfully !'));
                    $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                    return $resultRedirect->setPath('*/*/');
                }
            } catch (\Exception $e) {
                $this->messageManager->addError(__($e->getMessage()));
            }
        $this->_redirect('*/*/index');
    }
}
