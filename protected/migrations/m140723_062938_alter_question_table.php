<?php

class m140723_062938_alter_question_table extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('Question', 'one_answer');
        $this->addColumn('Question', 'type', "enum('radio','check','text') DEFAULT NULL");
	}

	public function down()
	{
		echo "m140723_062938_alter_question_table does not support migration down.\n";
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