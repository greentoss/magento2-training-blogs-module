<?php

namespace Shkil\Blogposts\Model\Source\Config;

use Magento\Framework\Data\OptionSourceInterface;

class DateFormat implements OptionSourceInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return
        [
          ['label' => '2000-01-31', 'value' => 'Y-m-d'],
          ['label' => '31-01-2000', 'value' => 'd-m-Y'],
          ['label' => '01-31-2000', 'value' => 'm-d-Y']
        ];
    }
}
