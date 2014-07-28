<?
Yii::app()->clientScript->registerScriptFile('/js/jquery.fancybox.pack.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('modal', 'modal.init()', CClientScript::POS_READY);
Yii::app()->clientScript->registerCssFile('/css/jquery.fancybox.css');
?>
<?=CHtml::link('modal',array('calendar/event'),array('class'=>'event'))?>