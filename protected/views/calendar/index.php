<?
Yii::app()->clientScript->registerScriptFile('/js/jquery.fancybox.pack.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('modal', 'modal.init()', CClientScript::POS_READY);
Yii::app()->clientScript->registerCssFile('/css/jquery.fancybox.css');
Yii::app()->clientScript->registerScriptFile('/js/moment.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('/js/locales/bootstrap-datetimepicker.ru.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('/js/bootstrap-datetimepicker.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile('/css/bootstrap-datetimepicker.min.css');
Yii::app()->clientScript->registerScript('calendarInit', 'calendar.init()', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/extension/jquery.print.js', CClientScript::POS_END);
?>

<ul class="nav nav-tabs" id="calendar-tabs">
    <li class="active" data-tab="day"><a data-toggle="tab" href="/calendar/index#day-calendar"><?=Yii::t('main','День')?></a></li>
    <li class="" data-tab="week"><a data-toggle="tab" href="/calendar/index#week-calendar"><?=Yii::t('main','Неделя')?></a></li>
        <div class="datepicker-input input-group col-xs-4 pull-right" id="calendar-datepicker" data-date-format="DD/MM/YYYY">
            <?=CHtml::textField('event[date]','',array('class'=>'form-control','placeholder'=>Yii::t('main','Укажите дату')))?>
            <span class="input-group-addon"><span data-date-icon="icon-calendar" data-time-icon="icon-time" class="icon-calendar"></span></span>
        </div>
    <li class="" data-tab="find"><a data-toggle="tab" href="/calendar/index#find"><?=Yii::t('main','Поиск')?></a></li>
</ul>
    <?=CHtml::hiddenField('user_id', $user->id, array('id' => 'user_id'));?>
<div class="tab-content" id="calendar-tab-content">
    <div class="tab-pane active" id="day-calendar">
        <?php $this->renderPartial('_dayCalendar',array(
        'user' => $user,
        'date' => $date
    )); ?>
    </div>
    <div class="tab-pane" id="week-calendar">
        <?php $this->renderPartial('_weekCalendar',array(
        'user' => $user,
        'date' => $date
    )); ?>
    </div>
    <div class="tab-pane" id="find">
        <?php $this->renderPartial('_find',array(
            'user' => $user,
            'date' => $date,
            'find'=>$find,
        )); ?>
    </div>
</div>

<div class="hidden">
    <div id="print-list"></div>
</div>
