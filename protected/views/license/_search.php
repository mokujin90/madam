<?php
/* @var $this LicenseController */
/* @var $model License */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'question'); ?>
		<?php echo $form->textField($model,'question',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'control_dialog'); ?>
		<?php echo $form->textField($model,'control_dialog'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'group_event'); ?>
		<?php echo $form->textField($model,'group_event'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email_confirm'); ?>
		<?php echo $form->textField($model,'email_confirm'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sms_confirm'); ?>
		<?php echo $form->textField($model,'sms_confirm'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email_reminder'); ?>
		<?php echo $form->textField($model,'email_reminder'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sms_reminder'); ?>
		<?php echo $form->textField($model,'sms_reminder'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'multilanguage'); ?>
		<?php echo $form->textField($model,'multilanguage'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'event_confirm'); ?>
		<?php echo $form->textField($model,'event_confirm'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email_event'); ?>
		<?php echo $form->textField($model,'email_event'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sms_event'); ?>
		<?php echo $form->textField($model,'sms_event'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'caldav'); ?>
		<?php echo $form->textField($model,'caldav'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email_help'); ?>
		<?php echo $form->textField($model,'email_help'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone_help'); ?>
		<?php echo $form->textField($model,'phone_help'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employee'); ?>
		<?php echo $form->textField($model,'employee',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'max_employee'); ?>
		<?php echo $form->textField($model,'max_employee',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'event'); ?>
		<?php echo $form->textField($model,'event',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sms'); ?>
		<?php echo $form->textField($model,'sms',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'base_lvl'); ?>
		<?php echo $form->textField($model,'base_lvl'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_system'); ?>
		<?php echo $form->textField($model,'is_system'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'request_text'); ?>
		<?php echo $form->textArea($model,'request_text',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'max_sms'); ?>
		<?php echo $form->textField($model,'max_sms'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->