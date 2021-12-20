<?php
 
namespace Warehouse\Features\Plugin;
    use Magento\Framework\Data\Tree\NodeFactory;
    use Magento\Framework\UrlInterface;
 
class Topmenu
    {
        protected $nodeFactory;
        protected $urlBuilder;
 
        public function __construct(NodeFactory $nodeFactory, UrlInterface $urlBuilder)
        {
            $this->nodeFactory = $nodeFactory;
            $this->urlBuilder = $urlBuilder;
        }
 
        public function beforeGetHtml(\Magento\Theme\Block\Html\Topmenu $subject, $outermostClass = '', $childrenWrapClass = '', $limit = 2)
        {
            $menuNode = $this->nodeFactory->create(['data' => $this->getNodeAsArray("Profile", "mnuMain"),
                'idField' => 'id',
                'tree' => $subject->getMenu()->getTree(),]);
            $menuNode->addChild($this->nodeFactory->create(['data' => $this->getNodeAsArray("MainMenu", "mnuMyMenu"),
                'idField' => 'id',
                'tree' => $subject->getMenu()->getTree(),]));

            // $menuNode->addChild($this->nodeFactory->create(['data' => $this->getNodeAsArray("Main Menu1", "mnuMyMenu"),
            //     'idField' => 'id',
            //     'tree' => $subject->getMenu()->getTree(),]));
 
            $subject->getMenu()->addChild($menuNode);
        }
 
        protected function getNodeAsArray($name, $id)
        {
            $url = $this->urlBuilder->getUrl("anadin/features/indexfeat" . $id); //here you can add url as per your choice of menu
            if(!$url){
            return ['name' => __($name),
                'id' => $id,
                'url' => $url,
                'has_active' => false,
                'is_active' => false,];
            }
            else
            {
                return ['name' => __($name),
                'id' => $id,
                'url' => "",
                'has_active' => false,
                'is_active' => false,];
            }
        }
    }