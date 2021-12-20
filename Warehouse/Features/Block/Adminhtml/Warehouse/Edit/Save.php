<?php

namespace Warehouse\Features\Block\Adminhtml\Warehouse\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Save implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {

        return [

            'label' => __('Save'),

            'class' => 'save primary',

            'data_attribute' => [

                'mage-init' => ['button' => ['event' => 'save']],

                'form-role' => 'save',

            ],

            'sort_order' => 90,

        ];
    }
}
