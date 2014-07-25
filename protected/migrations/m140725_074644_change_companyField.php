<?php

class m140725_074644_change_companyField extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE `CompanyField` ADD COLUMN `is_userfield` INT(3) DEFAULT 0 NOT NULL AFTER `position`;";
        Yii::app()->db->createCommand($sql)->execute();

	}

	public function down()
	{
		echo "m140725_074644_change_companyField does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}