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
			//'component' => 'Magento_Ui/js/form/element/abstract',
			'component' => 'Bhavin_GDPR/js/view/checkout-shipping-agreements',
			/*'config' => [
					'customScope' => 'shippingAddress.custom_attributes',
					'template' => 'Bhavin_GDPR/js/view/checkout-shipping-agreements',
					'elementTmpl' => 'ui/form/element/checkbox',
				],
				'dataScope' => 'shippingAddress.custom_attributes' . '.' . $shippingAgreementAttributeCode,
				'label' => __('Agreements'),
				'provider' => 'checkoutProvider',
				'sortOrder' => 200,
				'validation' => [
					'required-entry' => true,
				],
				'options' => [],
				'filterBy' => null,
				'customEntry' => null,
				'visible' => true, 'additionalClass' => "required",
			*/
		];
		$jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$shippingAgreementAttributeCode] = $shippingGdprField;

		return $jsLayout;
	}

}
