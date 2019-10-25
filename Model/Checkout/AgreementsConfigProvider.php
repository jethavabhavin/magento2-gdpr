<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bhavin\GDPR\Model\Checkout;

use Magento\CheckoutAgreements\Model\AgreementsProvider;
use Magento\Framework\App\ObjectManager;
use Magento\Store\Model\ScopeInterface;

/**
 * Configuration provider for GiftMessage rendering on "Shipping Method" step of checkout.
 */
class AgreementsConfigProvider extends \Magento\CheckoutAgreements\Model\AgreementsConfigProvider {
	/**
	 * Returns agreements config
	 *
	 * @return array
	 */
	protected function getAgreementsConfig() {
		$agreementConfiguration = [];
		$isAgreementsEnabled = $this->scopeConfiguration->isSetFlag(
			AgreementsProvider::PATH_ENABLED,
			ScopeInterface::SCOPE_STORE
		);

		$om = ObjectManager::getInstance();
		$helper = $om->get('Bhavin\GDPR\Helper\Data');

		$isBillingAgreementsEnabled = $helper->isEnableOnShipping();

		$isShippingAgreementsEnabled = $helper->isEnableOnBilling();

		$om = \Magento\Framework\App\ObjectManager::getInstance();
		

		$agreementsList = $om->create("Magento\CheckoutAgreements\Model\ResourceModel\Agreement\Collection");

		$agreementConfiguration['isEnabled'] = (bool) ($isAgreementsEnabled && count($agreementsList) > 0);
		$agreementConfiguration['isEnabledShipping'] = (bool) ($isBillingAgreementsEnabled && count($agreementsList) > 0);
		$agreementConfiguration['isEnabledBilling'] = (bool) ($isShippingAgreementsEnabled && count($agreementsList) > 0);
		$agreementConfiguration['agreements']=[];

		foreach ($agreementsList as $agreement) {
			$agreementConfiguration['agreements'][$agreement->getDisplayArea()][] = [
				'content' => $agreement->getIsHtml()
				? $agreement->getContent()
				: nl2br($this->escaper->escapeHtml($agreement->getContent())),
				'checkboxText' => $agreement->getCheckboxText(),
				'mode' => $agreement->getMode(),
				'agreementId' => $agreement->getAgreementId(),
			];
		}

		return $agreementConfiguration;
	}
}
