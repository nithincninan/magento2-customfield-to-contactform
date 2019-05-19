<?php
/**
 * Module Contact Subject Source Model
 * @package MODULE\Contact
 */
declare(strict_types=1);

namespace Module\Contact\Model\Config\Source;

/**
 * @api
 * @since 100.0.2
 */
class Subject implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $data = [];
        foreach ($this->toArray() as $key => $value) {
            $data[] = ['value' => $key, 'label' => $value];
        }
        return $data;
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [
            0 => __('Select Subject'),
            1 => __('Customer Service'),
            2 => __('Order Status'),
            3 => __('Products'),
            4 => __('Website Suggestions')
        ];
    }
}
