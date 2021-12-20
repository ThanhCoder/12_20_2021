<?php

namespace Warehouse\Features\Controller\Features;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use Warehouse\Features\Model\FeaturesFactory;

class Update extends Action
{
    protected $resultPageFactory;
    protected $extensionFactory;
    private $url;

    public function __construct(
        UrlInterface    $url,
        Context         $context,
        PageFactory     $resultPageFactory,
        FeaturesFactory $extensionFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->extensionFactory = $extensionFactory;
        $this->url = $url;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = (array)$this->getRequest()->getPost();
        //var_dump($data);
        //die();
        if ($data) {
            try {
                $id = $data['id'] ?? null;
                // lay du lieu tu cot banner_id bang load(id)
                $model = $this->extensionFactory->create();
                //var_dump($model->getData());
                //die();
                if ($id) {
                    $model->load($id);
                    //var_dump($model->getId());
                    //die();
                }

                $saveData = $model->addData($data)->save();

                if ($saveData) {
                    $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
                }
            } /*if ($data) {
                $model = $this->extensionFactory->create();
                $model->setData($data)->save();
                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
            }*/
            catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
            }
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->url->getUrl('anadin/features/indexfeat'));
        return $resultRedirect;
    }
}
