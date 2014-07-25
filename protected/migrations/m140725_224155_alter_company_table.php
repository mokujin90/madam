<?php

class m140725_224155_alter_company_table extends CDbMigration
{
	public function up()
	{
        $sql = "
        /* 2:27:47 AM  localhost */ ALTER TABLE `Company` ADD `url` VARCHAR(255)  NULL  DEFAULT NULL  AFTER `country_id`;
        /* 2:28:57 AM  localhost */ ALTER TABLE `Company` ADD `booking_deadline`  INT(11)  NOT NULL  DEFAULT '1'  AFTER `url`;
        /* 2:29:24 AM  localhost */ ALTER TABLE `Company` ADD `booking_interval` INT(11)  NOT NULL  DEFAULT '1'  AFTER `booking_deadline`;
        /* 2:34:14 AM  localhost */ ALTER TABLE `Company` ADD `enable_mail_notice` TINYINT  NOT NULL  DEFAULT '0'  AFTER `booking_interval`;
        /* 2:35:00 AM  localhost */ ALTER TABLE `Company` ADD `mail_notice_address` VARCHAR(255)  NULL  DEFAULT NULL  AFTER `enable_mail_notice`;
        /* 2:35:23 AM  localhost */ ALTER TABLE `Company` ADD `enable_sms_notice` TINYINT  NOT NULL  DEFAULT '0'  AFTER `mail_notice_address`;
        /* 2:36:01 AM  localhost */ ALTER TABLE `Company` ADD `sms_notice_phone` VARCHAR(20)  NULL  DEFAULT NULL  AFTER `enable_sms_notice`;
        /* 2:36:18 AM  localhost */ ALTER TABLE `Company` ADD `hello_text` TEXT  NULL  AFTER `sms_notice_phone`;
        /* 2:37:56 AM  localhost */ ALTER TABLE `Company` ADD `select_timetable` TINYINT  NOT NULL  DEFAULT '0'  AFTER `hello_text`;
        ";

        Yii::app()->db->createCommand($sql)->execute();

        $cacher = Yii::app()->getComponent(Yii::app()->db->schemaCacheID);
        if ($cacher)
            $cacher->flush();

	}

	public function down()
	{
		echo "m140725_224155_alter_company_table does not support migration down.\n";
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