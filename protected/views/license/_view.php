<?php
/* @var $this LicenseController */
/* @var $data License */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('question')); ?>:</b>
	<?php echo CHtml::encode($data->question); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('control_dialog')); ?>:</b>
	<?php echo CHtml::encode($data->control_dialog); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('group_event')); ?>:</b>
	<?php echo CHtml::encode($data->group_event); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_confirm')); ?>:</b>
	<?php echo CHtml::encode($data->email_confirm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sms_confirm')); ?>:</b>
	<?php echo CHtml::encode($data->sms_confirm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_reminder')); ?>:</b>
	<?php echo CHtml::encode($data->email_reminder); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sms_reminder')); ?>:</b>
	<?php echo CHtml::encode($data->sms_reminder); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('multilanguage')); ?>:</b>
	<?php echo CHtml::encode($data->multilanguage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_confirm')); ?>:</b>
	<?php echo CHtml::encode($data->event_confirm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_event')); ?>:</b>
	<?php echo CHtml::encode($data->email_event); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sms_event')); ?>:</b>
	<?php echo CHtml::encode($data->sms_event); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caldav')); ?>:</b>
	<?php echo CHtml::encode($data->caldav); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_help')); ?>:</b>
	<?php echo CHtml::encode($data->email_help); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_help')); ?>:</b>
	<?php echo CHtml::encode($data->phone_help); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee')); ?>:</b>
	<?php echo CHtml::encode($data->employee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('max_employee')); ?>:</b>
	<?php echo CHtml::encode($data->max_employee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event')); ?>:</b>
	<?php echo CHtml::encode($data->event); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sms')); ?>:</b>
	<?php echo CHtml::encode($data->sms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('base_lvl')); ?>:</b>
	<?php echo CHtml::encode($data->base_lvl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_system')); ?>:</b>
	<?php echo CHtml::encode($data->is_system); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('request_text')); ?>:</b>
	<?php echo CHtml::encode($data->request_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('max_sms')); ?>:</b>
	<?php echo CHtml::encode($data->max_sms); ?>
	<br />

	*/ ?>

</div>