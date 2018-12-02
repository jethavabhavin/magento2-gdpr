<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bhavin\GDPR\Block\Gdpr;

/**
 * @api
 * @since 100.0.2
 */
class Agreements extends \Magento\Framework\View\Element\Template {
	/**
	 * @var \Magento\CheckoutAgreements\Model\ResourceModel\Agreement\CollectionFactory
	 */
	protected $_collectionFactory;
	/**
	 * @var \Magento\Store\Model\StoreManagerInterface
	 */
	protected $_storeManager;
	/**
	 * @param \Magento\Framework\View\Element\Template\Context $context
	 * @param \Magento\Store\Model\StoreManagerInterface $storeManager
	 * @param \Magento\CheckoutAgreements\Model\ResourceModel\Agreement\CollectionFactory $collectionFactory
	 * @param array $data
	 */
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Magento\CheckoutAgreements\Model\ResourceModel\Agreement\CollectionFactory $collectionFactory,
		$data = []
	) {
		parent::__construct($context, $data);
		$this->_collectionFactory = $collectionFactory;
		$this->_storeManager = $storeManager;
	}
	/**
	 * Get getAgreements
	 * @return \Magento\CheckoutAgreements\Model\ResourceModel\Agreement\Collection
	 */
	public function getAgreements() {
		$agreements = $this->_collectionFactory->create();
		$agreements->addFieldToFilter('is_active', 1);
		$agreements->addFieldToFilter('display_area', $this->getDisplayArea());
		$agreements->addStoreFilter($this->_storeManager->getStore()->getId());
		return $agreements;
	}
}
