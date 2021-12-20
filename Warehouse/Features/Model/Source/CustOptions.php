<?php
/**
 * Code standard by : RH
 */

namespace Warehouse\Features\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class AttributeListOptions implements OptionSourceInterface
{
    protected $attributeOptionsList = [];

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $this->attributeOptionsList = [
            [
                'value' => "Test 1",
                "label" => "Test 1",
                "__disableTmpl" => 1,
                "optgroup" => [
                    [
                        'value' => "Test 1.1",
                        "label" => "Test 1.1",
                        "__disableTmpl" => 1,
                    ],
                ],
            ],
        ];
        return $this->attributeOptionsList;
    }
}
