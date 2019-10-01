<?php

namespace Magecomp\Ordercomment\Model\Config\Source;

class Defaultshow implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Closed')],
            ['value' => 1, 'label' => __('Opened')],
            ['value' => 2, 'label' => __('Without collapse')],
        ];


    }

}
