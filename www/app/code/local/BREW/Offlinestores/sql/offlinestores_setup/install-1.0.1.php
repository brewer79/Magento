<?php
/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();
$installer->run("
ALTER TABLE `{$this->getTable('offlinestores/block')}` (
  `block_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY;
");
$installer->endSetup();