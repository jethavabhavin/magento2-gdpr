<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Display Area source model
 */
namespace Bhavin\GDPR\Model\Source;

/**
 * Class Status
 * @api
 * @since 100.0.2
 */
class DisplayArea implements \Magento\Framework\Option\ArrayInterface {
	const CHECKOUT_FORM = 'checkout_form';
	const CHECKOUT_SHIPPING = 'checkout_shipping_form';
	const CHECKOUT_BILLING = 'checkout_billing_form';
	const CUSTOMER_REGISTRATION = 'customer_registration_form';
	const CUSTOMER_PROFILE = 'customer_profile_form';
	const CUSTOMER_ADDRESS = 'customer_address_form';
	const CUSTOMER_SUBSCRIPTION = 'subscription_form';
	const CUSTOMER_CONTACT_FORM = 'contact_form';
	const PRODUCT_REVIEW_FORM = 'product_review_form';
	/**
	 * @var string[]
	 */
	protected static $_areas = [
		Self::CHECKOUT_FORM => "Checkout Form",
		Self::CHECKOUT_SHIPPING => "Checkout Shipping Form",
		Self::CHECKOUT_BILLING => "Checkout Billing Form",
		Self::CUSTOMER_REGISTRATION => "Registration Form",
		Self::CUSTOMER_PROFILE => "Customer Profile Form",
		Self::CUSTOMER_ADDRESS => "Customer Adress Form",
		Self::CUSTOMER_SUBSCRIPTION => "Subscription Form",
		Self::CUSTOMER_CONTACT_FORM => "Contact Form",
		Self::PRODUCT_REVIEW_FORM => "Product Review Form",
	];

	/**
	 * @var \Magento\Sales\Model\Order\Config
	 */
	protected $_orderConfig;

	/**
	 * @param \Magento\Sales\Model\Order\Config $orderConfig
	 */
	public function __construct(\Magento\Sales\Model\Order\Config $orderConfig) {
		$this->_orderConfig = $orderConfig;
	}

	/**
	 * @return array
	 */
	public static function getOptions() {
		return Self::$_areas;
	}
	/**
	 * @return array
	 */
	public function toOptionArray() {
		$areas = Self::$_areas;
		$options = [];
		foreach ($areas as $code => $label) {
			$options[] = ['value' => $code, 'label' => $label];
		}
		return $options;
	}
}
