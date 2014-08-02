<?php
/* @var $this LicenseController */
/* @var $model License */

$this->breadcrumbs=array(
	'Licenses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List License', 'url'=>array('index')),
	array('label'=>'Create License', 'url'=>array('create')),
	array('label'=>'Update License', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete License', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage License', 'url'=>array('admin')),
);
?>

<h1>View License #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'question',
		'control_dialog',
		'group_event',
		'email_confirm',
		'sms_confirm',
		'email_reminder',
		'sms_reminder',
		'multilanguage',
		'event_confirm',
		'email_event',
		'sms_event',
		'caldav',
		'email_help',
		'phone_help',
		'employee',
		'max_employee',
		'event',
		'sms',
		'base_lvl',
		'is_system',
		'request_text',
		'max_sms',
	),
)); ?>
