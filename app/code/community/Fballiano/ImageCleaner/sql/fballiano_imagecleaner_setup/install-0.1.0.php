<?php
/**
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   FBalliano
 * @package    FBalliano_ImageCleaner
 * @copyright  Copyright (c) Fabrizio Balliano (http://fabrizioballiano.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$installer->run("
DROP TABLE IF EXISTS {$this->getTable('fb_imagecleaner_image')};
CREATE TABLE `{$this->getTable( 'fb_imagecleaner_image' )}` (
	`image_id` int unsigned AUTO_INCREMENT,
	`entity_type_id` smallint (5) unsigned NOT NULL,
	`path` varchar(255) NOT NULL,
	PRIMARY KEY (`image_id`),
	UNIQUE KEY `entity_type_id` (`entity_type_id`,`path`)
);");
$installer->endSetup();
