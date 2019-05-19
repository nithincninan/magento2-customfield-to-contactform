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
            0 => __('Select A Subject'),
            1 => __('General Customer Service'),
            2 => __('Returns'),
            3 => __('Order Status'),
            4 => __('International Order Inquiry'),
            5 => __('Our Products'),
            6 => __('Shipping Question'),
            7 => __('Combine Auctions'),
            8 => __('Auction Inquiry'),
            9 => __('Customer Info Change'),
            10 => __('Website Suggestions'),
            11 => __('Website Issues')
        ];
    }
}
