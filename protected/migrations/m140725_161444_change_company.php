<?php

class m140725_161444_change_company extends CDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE `Country`( `id` INT(3) NOT NULL AUTO_INCREMENT, `name` VARCHAR(100) NOT NULL, PRIMARY KEY (`id`) ); ";
        Yii::app()->db->createCommand($sql)->execute();
        $sql = "ALTER TABLE `Company`  ADD COLUMN `description` TEXT NULL AFTER `address`,
        ADD COLUMN `zip` TEXT(35) NULL AFTER `description`,
        ADD COLUMN `city` VARCHAR(255) NULL AFTER `zip`,
        ADD COLUMN `phone` VARCHAR(20) NULL AFTER `city`,
        ADD COLUMN `mobile_phone` VARCHAR(20) NULL AFTER `phone`,
         ADD COLUMN `fax` VARCHAR(20) NULL AFTER `mobile_phone`,
         ADD COLUMN `email` VARCHAR(100) NULL AFTER `fax`,
         ADD COLUMN `site` VARCHAR(255) NULL AFTER `email`,
         ADD COLUMN `country_id` INT(3) NOT NULL AFTER `site`;";
        Yii::app()->db->createCommand($sql)->execute();
        $sql = "INSERT INTO `Country` (`id`, `name`) VALUES (NULL, 'Россия');";
        Yii::app()->db->createCommand($sql)->execute();
        $sql = "UPDATE Company SET country_id=1;";
        Yii::app()->db->createCommand($sql)->execute();
        $sql = "ALTER TABLE `Company` ADD CONSTRAINT `CountryRelation` FOREIGN KEY (`country_id`) REFERENCES `Country`(`id`) ON UPDATE CASCADE ON DELETE NO ACTION; ";
        Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
		echo "m140725_161444_change_company does not support migration down.\n";
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