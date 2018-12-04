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
		];

		$billingGdprField = [
			'component' => 'Bhavin_GDPR/js/view/checkout-billing-agreements',
		];

		$jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$shippingAgreementAttributeCode] = $shippingGdprField;

		$configuration = $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children'];
		foreach ($configuration as $paymentGroup => $groupConfig) {
			if (isset($groupConfig['component']) AND $groupConfig['component'] === 'Magento_Checkout/js/view/billing-address') {

				$jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
				['payment']['children']['payments-list']['children'][$paymentGroup]['children']['form-fields']['children'][$billingAgreementAttributeCode] = $billingGdprField;
			}
		}
		/*echo "<pre>";
		print_r($jsLayout);exit;*/
		return $jsLayout;
	}

}
