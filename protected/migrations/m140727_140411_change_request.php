<?php

class m140727_140411_change_request extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE `Request` ADD COLUMN `is_allday` INT(3) DEFAULT 0 NOT NULL AFTER `end_time`;";
        Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
		echo "m140727_140411_change_request does not support migration down.\n";
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