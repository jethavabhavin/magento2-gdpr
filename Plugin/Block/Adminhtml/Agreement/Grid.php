<?php

namespace Bhavin\GDPR\Plugin\Block\Adminhtml\Agreement;

use Bhavin\GDPR\Model\Source\DisplayArea;

class Grid {
	/**
	 * @param \Magento\CheckoutAgreements\Block\Adminhtml\Agreement\Grid $blockGrid
	 * @return \Magento\CheckoutAgreements\Block\Adminhtml\Agreement\Grid
	 */
	public function beforeSetLayout(
		\Magento\CheckoutAgreements\Block\Adminhtml\Agreement\Grid $blockGrid
	) {
		$blockGrid->addColumnAfter(
			'display_area',
			[
				'header' => __('Display Area'),
				'index' => 'display_area',
				'type' => 'options',
				'options' => DisplayArea::getOptions(),
				'header_css_class' => 'col-status',
				'column_css_class' => 'col-status',
			],
			'name'
		);
	}
}