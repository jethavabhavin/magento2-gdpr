<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bhavin\GDPR\Block\Checkout;

/**
 * Class LayoutProcessor
 */
class LayoutProcessor implements \Magento\Checkout\Block\Checkout\LayoutProcessorInterface {
	/**
	 * Process js Layout of block
	 *
	 * @param array $jsLayout
	 * @return array
	 */
	public function process($jsLayout) {
		$shippingAgreementAttributeCode = 'shipping_address_gdpr';
		$billingAgreementAttributeCode = 'billing_address_gdpr';

		$shippingGdprField = [
			'component' => 'Bhavin_GDPR/js/view/checkout-shipping-agreements',
			'config' => [
				'customScope' => 'shippingAddress.custom_attributes',
			],
			'dataScope' => 'shippingAddress.custom_attributes' . '.' . $shippingAgreementAttributeCode,
			'provider' => 'checkoutProvider',
			'label' => __('Agreements'),
			'validation' => [
				'required-entry' => true,
			],
		];
		$jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$shippingAgreementAttributeCode] = $shippingGdprField;

		return $jsLayout;
	}

}
