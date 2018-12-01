<?php

namespace Bhavin\GDPR\Plugin\Block\Adminhtml\Agreement\Edit;

use Bhavin\GDPR\Model\Source\DisplayArea;

class Form {
	/**
	 * @var \Magento\Framework\Registry
	 */
	protected $_registry;
	/**
	 * @param \Magento\Framework\Registry $registry
	 * @codeCoverageIgnore
	 */
	public function __construct(
		\Magento\Framework\Registry $registry
	) {
		$this->_registry = $registry;}

	public function afterSetForm(
		\Magento\CheckoutAgreements\Block\Adminhtml\Agreement\Edit\Form $blockForm,
		\Magento\CheckoutAgreements\Block\Adminhtml\Agreement\Edit\Form $blockFormReturn,
		\Magento\Framework\Data\Form $formArg
	) {
		$agreement = $this->_registry->registry('checkout_agreement');

		$fieldset = $formArg->addFieldset(
			'display_fieldset',
			['legend' => __('Display Area'), 'class' => 'fieldset-wide']
		);

		$fieldset->addField(
			'display_area',
			'select',
			[
				'name' => 'display_area',
				'label' => __('Display Area'),
				'title' => __('Display Area'),
				'required' => true,
				'value' => $agreement->getDisplayArea(),
				'options' => DisplayArea::getOptions(),
			]
		);

		return $blockFormReturn;
	}
}