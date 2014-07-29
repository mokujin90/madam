<?
Yii::app()->clientScript->registerScriptFile('/js/jquery.fancybox.pack.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('modal', 'modal.init()', CClientScript::POS_READY);
Yii::app()->clientScript->registerCssFile('/css/jquery.fancybox.css');
Yii::app()->clientScript->registerScriptFile('/js/moment.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('/js/locales/bootstrap-datetimepicker.ru.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('/js/bootstrap-datetimepicker.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile('/css/bootstrap-datetimepicker.min.css');
?>
<script>
    var calendarOnChange = false;
    $(function(){
        $("#calendar-datepicker").on('change.dp', function(e) {
            if(calendarOnChange){
                return;
            } else {
                calendarOnChange = true;
                $.ajax({
                    type: 'GET',
                    url: '/calendar/changeCalendarDate',
                    async: true,
                    dataType: 'html',
                    data: {
                        date: $("#calendar-datepicker").data("DateTimePicker").getDate().format('YYYY-MM-DD'),
                        user_id: $("#user_id").val(),
                        active_tab: $('#calendar-tabs .active').data('tab')
                    },
                    error: function () {
                        $.jGrowl("Ошибка сервера");
                        calendarOnChange = false;
                    },
                    success: function (data) {
                        $('#calendar-tab-content').html(data);
                        calendarOnChange = false;
                        $.jGrowl("Календарь обновлен");
                    }
                });
            }
        });
    })
</script>
<ul class="nav nav-tabs" id="calendar-tabs">
    <li class="active" data-tab="day"><a data-toggle="tab" href="/calendar/index#day-calendar">День</a></li>
    <li class="" data-tab="week"><a data-toggle="tab" href="/calendar/index#week-calendar">Неделя</a></li>
        <div class="datepicker-input input-group col-xs-4 pull-right" id="calendar-datepicker">
            <?=CHtml::textField('event[date]','',array('class'=>'form-control','data-format'=>"YYYY-MM-DD",'placeholder'=>Yii::t('main','Укажите дату')))?>
            <span class="input-group-addon"><span data-date-icon="icon-calendar" data-time-icon="icon-time" class="icon-calendar"></span></span>
        </div>
</ul>
    <?=CHtml::hiddenField('user_id', $user->id, array('id' => 'user_id'));?>
<div class="tab-content" id="calendar-tab-content">
    <div class="tab-pane active" id="day-calendar">
        <?php $this->renderPartial('_dayCalendar',array(
        'user' => $user
    )); ?>
    </div>
    <div class="tab-pane" id="week-calendar">
        <?php $this->renderPartial('_weekCalendar',array(
        'user' => $user
    )); ?>
    </div>
</div>
