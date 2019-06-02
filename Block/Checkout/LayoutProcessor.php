<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bhavin\GDPR\Block\Checkout;

use Bhavin\GDPR\Model\Source\DisplayArea;
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
		$om = \Magento\Framework\App\ObjectManager::getInstance();
		$helper = $om->get('Bhavin\GDPR\Helper\Data');
			
		if ($helper->isEnableOnShipping()) {
			 $agreements = $om->create("Magento\CheckoutAgreements\Model\ResourceModel\Agreement\Collection");
			 $agreements->addFieldToFilter("display_area",DisplayArea::CHECKOUT_SHIPPING);
	
			if($agreements->getSize())
			{
				$shippingAgreementAttributeCode = 'shipping_address_gdpr';

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
			}
		}	
		if ($helper->isEnableOnBilling()) {
			$agreements = $om->create("Magento\CheckoutAgreements\Model\ResourceModel\Agreement\Collection");
			$agreements->addFieldToFilter("display_area",DisplayArea::CHECKOUT_BILLING);
			if($agreements->getSize())
			{
				$billingAgreementAttributeCode = 'billing_address_gdpr';
				$jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$shippingAgreementAttributeCode] = $shippingGdprField;

				$configuration = $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children'];
				foreach ($configuration as $paymentGroup => $groupConfig) {
					if (isset($groupConfig['component']) AND $groupConfig['component'] === 'Magento_Checkout/js/view/billing-address') {
						$dataScopePrefix = $groupConfig['dataScopePrefix'];
						$billingGdprField = [
							'component' => 'Bhavin_GDPR/js/view/checkout-billing-agreements',
							'config' => [
								'customScope' => "{$dataScopePrefix}.custom_attributes",
							],
							'dataScope' => "{$dataScopePrefix}.custom_attributes" . '.' . $billingAgreementAttributeCode,
							'provider' => 'checkoutProvider',
							'label' => __('Agreements'),
							'validation' => [
								'required-entry' => true,
							],
						];
						$jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children'][$paymentGroup]['children']['form-fields']['children'][$billingAgreementAttributeCode] = $billingGdprField;
					}
				}	
			}
			
		}

		return $jsLayout;
	}

}
