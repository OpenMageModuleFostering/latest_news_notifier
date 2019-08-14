<?php

$installer = $this;

$installer->startSetup();

$installer->run("
		ALTER TABLE  `".$this->getTable('latestnews')."` ADD  `code` varchar(255) NOT NULL;		
		");

$installer->endSetup();