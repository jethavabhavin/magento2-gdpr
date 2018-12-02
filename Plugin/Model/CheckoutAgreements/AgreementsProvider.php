<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bhavin\GDPR\Plugin\Model\CheckoutAgreements;

use Bhavin\GDPR\Model\Source\DisplayArea;
use Magento\CheckoutAgreements\Model\AgreementModeOptions;
use Magento\CheckoutAgreements\Model\ResourceModel\Agreement\CollectionFactory as AgreementCollectionFactory;
use Magento\Store\Model\ScopeInterface;

/**
 * Provide Agreements stored in db
 */
class AgreementsProvider extends \Magento\CheckoutAgreements\Model\AgreementsProvider {

	/**
	 * Get list of required Agreement Ids
	 *
	 * @return int[]
	 */
	public function getRequiredAgreementIds() {
		$agreementIds = [];
		if ($this->scopeConfig->isSetFlag(self::PATH_ENABLED, ScopeInterface::SCOPE_STORE)) {
			$agreementCollection = $this->agreementCollectionFactory->create();
			$agreementCollection->addStoreFilter($this->storeManager->getStore()->getId());
			$agreementCollection->addFieldToFilter('is_active', 1);
			$agreementCollection->addFieldToFilter('display_area', DisplayArea::CHECKOUT_FORM);
			$agreementCollection->addFieldToFilter('mode', AgreementModeOptions::MODE_MANUAL);
			$agreementIds = $agreementCollection->getAllIds();
		}
		return $agreementIds;
	}
}
