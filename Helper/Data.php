<?php
/**
 * Copyright © Bhavin, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bhavin\GDPR\Helper;

use Bhavin\GDPR\Model\Source\DisplayArea;

/**
 * DeleteOrder module base helper
 *
 * @author Magento Core Team <core@magentocommerce.com>
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper {
	/**
	 * get allow to send new order confirmation email
	 *
	 * @param string $path
	 * @param bool $explode
	 *
	 * @return bool||array
	 */
	public function getConfig($path = null, $store = null) {
		$configValue = $this->scopeConfig->getValue(
			"bhavin_gdpr/general/" . $path,
			\Magento\Store\Model\ScopeInterface::SCOPE_STORE,
			$store
		);
		return $configValue;
	}
	/**
	 * Check module enable/disable on registration
	 *
	 * @return bool
	 */
	public function isEnableOnRegistration() {
		return $this->getConfig(DisplayArea::CUSTOMER_REGISTRATION);
	}
	/**
	 * Check module enable/disable on customer profile
	 *
	 * @return bool
	 */
	public function isEnableOnProfile() {
		return $this->getConfig(DisplayArea::CUSTOMER_PROFILE);
	}
	/**
	 * Check module enable/disable on customer address
	 *
	 * @return bool
	 */
	public function isEnableOnAddress() {
		return $this->getConfig(DisplayArea::CUSTOMER_ADDRESS);
	}
	/**
	 * Check module enable/disable on checkout shipping
	 *
	 * @return bool
	 */
	public function isEnableOnShipping() {
		return $this->getConfig(DisplayArea::CHECKOUT_SHIPPING);
	}
	/**
	 * Check module enable/disable on checkout billing
	 *
	 * @return bool
	 */
	public function isEnableOnBilling() {
		return $this->getConfig(DisplayArea::CHECKOUT_BILLING);
	}
	/**
	 * Check module enable/disable on contact form
	 *
	 * @return bool
	 */
	public function isEnableOnContact() {
		return $this->getConfig(DisplayArea::CUSTOMER_CONTACT_FORM);
	}
	/**
	 * Check module enable/disable on newsletter form
	 *
	 * @return bool
	 */
	public function isEnableOnNewsletter() {
		return $this->getConfig(DisplayArea::CUSTOMER_SUBSCRIPTION);
	}
	/**
	 * Check module enable/disable on Product Review form
	 *
	 * @return bool
	 */
	public function isEnableOnProductReview() {
		return $this->getConfig(DisplayArea::PRODUCT_REVIEW_FORM);
	}
}
