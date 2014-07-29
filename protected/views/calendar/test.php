<?
Yii::app()->clientScript->registerScriptFile('/js/jquery.fancybox.pack.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('modal', 'modal.init()', CClientScript::POS_READY);
Yii::app()->clientScript->registerCssFile('/css/jquery.fancybox.css');
?>
<?=CHtml::link('Существующее событие',array('calendar/event','id'=>11,'user_id'=>2),array('class'=>'event'))?>
<?=CHtml::link('Новое',array('calendar/event','user_id'=>2,'start'=>Help::currentDate(),'end'=>Help::currentDate()),array('class'=>'event'))?>