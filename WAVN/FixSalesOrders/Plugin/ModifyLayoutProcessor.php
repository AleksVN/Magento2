<?php


namespace WAVN\FixSalesOrders\Plugin;


use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;

class ModifyLayoutProcessor
{

    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessorInterface $subject
     * @param $result
     * @param array $jsLayout
     */
    public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessorInterface $subject, $result, $jsLayout)
    {
        $fields = $result["components"]["checkout"]["children"]["steps"]["children"]["shipping-step"]["children"]["shippingAddress"]["children"]["shipping-address-fieldset"]["children"];
        foreach ($fields as &$field) {
            $field["validation"]['max_text_length'] = 20;
        }
        $result["components"]["checkout"]["children"]["steps"]["children"]["shipping-step"]["children"]["shippingAddress"]["children"]["shipping-address-fieldset"]["children"] = $fields;

        $result["components"]["checkout"]["children"]["steps"]["children"]["shipping-step"]["children"]["shippingAddress"]["children"]["shipping-address-fieldset"]["children"]["company"]["validation"]['max_text_length'] = 10;


        return $result;
    }
}
