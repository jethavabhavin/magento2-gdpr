<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Bhavin\GDPR\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface {
	/**
	 * {@inheritdoc}
	 */
	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
		$installer = $setup;
		$installer->startSetup();

		$connection = $installer->getConnection();
		$column = [
			'type' => Table::TYPE_TEXT,
			'length' => 255,
			'nullable' => false,
			'comment' => 'Display Area',
			'default' => 'checkout_form',
			'after' => 'mode',
		];
		$connection->addColumn($installer->getTable('checkout_agreement'), 'display_area', $column);

		$installer->endSetup();
	}
}
