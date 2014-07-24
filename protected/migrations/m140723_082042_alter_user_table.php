<?php

class m140723_082042_alter_user_table extends CDbMigration
{
	public function up()
	{
        $sql = "
        /* 11:42:01 AM  localhost */ ALTER TABLE `User` ADD `name` VARCHAR(255)  NULL  DEFAULT NULL  AFTER `is_owner`;
        /* 11:47:57 AM  localhost */ ALTER TABLE `User` ADD `lastname` VARCHAR(255)  NULL  DEFAULT NULL  AFTER `name`;
        /* 11:53:13 AM  localhost */ ALTER TABLE `User` ADD `description` VARCHAR(255)  NULL  DEFAULT NULL  AFTER `lastname`;
        /* 11:56:36 AM  localhost */ ALTER TABLE `User` ADD `calendar_delimit` INT  NOT NULL  DEFAULT '10'  AFTER `description`;
        /* 11:56:56 AM  localhost */ ALTER TABLE `User` ADD `calendar_front_delimit` INT(11) NOT NULL  DEFAULT '-1'  AFTER `calendar_delimit`;
        /* 12:10:26 PM  localhost */ ALTER TABLE `User` ADD `caldav` VARCHAR(255)  NULL  DEFAULT NULL  AFTER `calendar_front_delimit`;
        ";

        Yii::app()->db->createCommand($sql)->execute();

        $cacher = Yii::app()->getComponent(Yii::app()->db->schemaCacheID);
        if ($cacher)
            $cacher->flush();

    }

	public function down()
	{
		echo "m140723_082042_alter_user_table does not support migration down.\n";
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