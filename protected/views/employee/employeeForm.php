<?php
    $this->layout = 'companyLayout';
    Yii::app()->clientScript->registerScriptFile('/js/datejs/core.js');
    Yii::app()->clientScript->registerScriptFile('/js/datejs/date.js');
?>

<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="http://terminland.art-kos.com/schedules_settings/schedules/#personal" role="tab" data-toggle="tab">Личные данные</a></li>
    <li class=""><a href="http://terminland.art-kos.com/schedules_settings/schedules/#worktime" role="tab" data-toggle="tab">Рабочее время</a></li>
    <li><a href="http://terminland.art-kos.com/schedules_settings/schedules/#types" role="tab" data-toggle="tab">Типы назначений</a></li>
</ul>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-update-form',
    'enableClientValidation'=>false,
    'htmlOptions' => array('class' => 'form-horizontal')
)); ?>
<div class="tab-content">
    <div class="tab-pane active" id="personal">
        <div class="col-xs-12 col-sm-8">
            <div class="form-group">
                <?= $form->labelEx($model,'login', array('class' => "col-xs-4 control-label")); ?>
                <div class="col-xs-4">
                    <?=$form->emailField($model,'login', array('class' => "form-control", 'type' => 'email', 'required' => 'required')); ?>
                </div>
                <div class="col-xs-4">
                    <?= $form->error($model,'login'); ?>
                </div>
            </div>
            <div class="form-group">
                <?= $form->labelEx($model,'password', array('class' => "col-xs-4 control-label")); ?>
                <div class="col-xs-4">
                    <?=$form->textField($model,'password', array('class' => "form-control", 'required' => 'required')); ?>
                </div>
                <div class="col-xs-4">
                    <?= $form->error($model,'password'); ?>
                </div>
            </div>
            <div class="form-group">
                <?= $form->labelEx($model,'name', array('class' => "col-xs-4 control-label")); ?>
                <div class="col-xs-4">
                    <?=$form->textField($model,'name', array('class' => "form-control")); ?>
                </div>
                <div class="col-xs-4">
                    <?= $form->error($model,'name'); ?>
                </div>
            </div>
            <div class="form-group">
                <?= $form->labelEx($model,'lastname', array('class' => "col-xs-4 control-label")); ?>
                <div class="col-xs-4">
                    <?=$form->textField($model,'lastname', array('class' => "form-control")); ?>
                </div>
                <div class="col-xs-4">
                    <?= $form->error($model,'lastname'); ?>
                </div>
            </div>
            <div class="form-group">
                <?= $form->labelEx($model,'description', array('class' => "col-xs-4 control-label")); ?>
                <div class="col-xs-4">
                    <?=$form->textField($model,'description', array('class' => "form-control", 'placeholder'=>"Специальность")); ?>
                </div>
                <div class="col-xs-4">
                    <?= $form->error($model,'description'); ?>
                </div>
            </div>
            <div class="form-group">
                <?= $form->labelEx($model,'calendar_delimit', array('class' => "col-xs-4 control-label")); ?>
                <div class="col-xs-4">
                    <?= $form->dropDownList($model, 'calendar_delimit', User::$calendarDelimit, array('class' => "form-control")); ?>
                </div>
                <div class="col-xs-1">
                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                </div>
                <div class="col-xs-3">
                    <?= $form->error($model,'calendar_delimit'); ?>
                </div>
            </div>
            <div class="form-group">
                <?$data = User::$calendarDelimit + array('-1' => 'Автоматически');?>
                <?= $form->labelEx($model,'calendar_front_delimit', array('class' => "col-xs-4 control-label")); ?>
                <div class="col-xs-4">
                    <?= $form->dropDownList($model, 'calendar_front_delimit', $data, array('class' => "form-control")); ?>
                </div>
                <div class="col-xs-1">
                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                </div>
                <div class="col-xs-3">
                    <?= $form->error($model,'calendar_front_delimit'); ?>
                </div>
            </div>
            <div class="form-group">
                <?= $form->labelEx($model,'caldav', array('class' => "col-xs-4 control-label")); ?>
                <div class="col-xs-4">
                    <?=$form->textField($model,'caldav', array('class' => "form-control")); ?>
                </div>
                <div class="col-xs-1">
                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                </div>
                <div class="col-xs-3">
                    <?= $form->error($model,'caldav'); ?>
                </div>
            </div>
        </div>
    </div>
    <?$scheduleArray = $model->getScheduleByDay();?>
    <div class="tab-pane" id="worktime">
        <div class="col-xs-12 col-sm-8">
            <?
                $scheduleUniqId = 0;
                for($i = 0; $i < 7; $i++) {
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box" style="margin-bottom:0">
                        <div class="box-header blue-background">
                            <div class="title"><?=Schedule::$dayNames[$i];?></div>
                            <div class="actions">
                                <div class="btn btn-link add-interval" data-day="<?=$i;?>"><i class="icon-plus"></i></div>

                                <a class="btn box-collapse btn-link" href="#"><i></i></a>
                            </div>
                        </div>
                        <div class="box-content">
                            <div class="col-xs-12 day-interval-wrap" data-day="<?=$i;?>">
                                <div class="row">
                                    <div class="col-xs-1">

                                    </div>
                                    <div class="col-xs-5 text-center">
                                        Время от
                                    </div>
                                    <div class="col-xs-5 text-center">
                                        Время до
                                    </div>
                                    <div class="col-xs-1 text-center">

                                    </div>
                                </div>
                                <hr class="margin-0">
                                <? if(isset($scheduleArray[$i])) foreach($scheduleArray[$i] as $scheduleRow){?>
                                <div class="row interval-row">
                                    <div class="col-xs-1">
                                        <button type="button" class="btn btn-danger remove-interval">-</button>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="col-md-12 col-lg-5">
                                            <select class="form-control start-hour-control" name="schedule[<?=$i;?>][<?=$scheduleUniqId;?>][startHour]">
                                                <? for($hour = 0; $hour < 24; $hour++) {
                                                    echo "<option value='$hour' " . ($hour == $scheduleRow['startHour'] ? 'selected' : '') . ">" . ($hour < 10 ? "0$hour" : $hour) . "</option>";
                                                }?>
                                            </select>
                                        </div>
                                        <div class="col-md-12 col-lg-2 time-delimit">:</div>
                                        <div class="col-md-12 col-lg-5">
                                            <select class="form-control start-min-control" name="schedule[<?=$i;?>][<?=$scheduleUniqId;?>][startMin]">
                                                <? for($min = 0; $min < 60; $min+=5) {
                                                    echo "<option value='$min' " . ($min == $scheduleRow['startMin'] ? 'selected' : '') . ">" . ($min < 10 ? "0$min" : $min) . "</option>";
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="col-md-12 col-lg-5">
                                            <select class="form-control end-hour-control" name="schedule[<?=$i;?>][<?=$scheduleUniqId;?>][endHour]">
                                                <? for($hour = 0; $hour < 24; $hour++) {
                                                    echo "<option value='$hour' " . ($hour == $scheduleRow['endHour'] ? 'selected' : '') . ">" . ($hour < 10 ? "0$hour" : $hour) . "</option>";
                                                }?>
                                            </select>
                                        </div>
                                        <div class="col-md-12 col-lg-2 time-delimit">:</div>
                                        <div class="col-md-12 col-lg-5 ">
                                            <select class="form-control end-min-control" name="schedule[<?=$i;?>][<?=$scheduleUniqId;?>][endMin]">
                                                <? for($min = 0; $min < 60; $min+=5) {
                                                    echo "<option value='$min' " . ($min == $scheduleRow['endMin'] ? 'selected' : '') . ">" . ($min < 10 ? "0$min" : $min) . "</option>";
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-1">
                                        <label class="checkbox-inline">
                                            <?=CHtml::checkBox("schedule[$i][$scheduleUniqId][enable]", $scheduleRow['enable']);?>
                                        </label>
                                    </div>
                                </div>
                                <hr class="margin-0">
                                <? $scheduleUniqId++; }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?}?>
            <input type="hidden" id="shedule-uniq-iq" value="<?=$scheduleUniqId;?>"/>
        </div>
        <div class="col-xs-12 col-sm-4">
            <h4>Рабочее время</h4>
                        <span>
                            Вставьте здесь свои рабочие часы в неделю, что. нажав на добавить работу в то время, день недели.
                            Нажав на удалить соответствующие рабочие часы.
                            Если вы хотите поделиться работу для онлайн-бронирования назначения, нажмите в последнем столбце
                            одноименной флажок.
                        </span>
        </div>
        </div>
    <div class="tab-pane" id="types">
        <div class="col-xs-12 col-sm-8">
            <div class="form-group">
                <label for="input1" class="col-xs-4 control-label">Ответы, одобрены для графика</label>
                <div class="col-xs-8">
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                            Все ответы
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                            Определенные ответы
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="input1" class="col-xs-4 control-label">What is your mobile phone?</label>
                <div class="col-xs-8">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                            Nokia
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                            Samsung
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                            iPhone
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="input1" class="col-xs-4 control-label">What's wrong with phone?</label>
                <div class="col-xs-8">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                            crashed screen
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                            Speaker does not work
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                            Keyboard does not work
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="input1" class="col-xs-4 control-label">What happened to the phone?</label>
                <div class="col-xs-8">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                            Fell into the water
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                            Fell to the ground
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                            moved car
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4">

        </div>
    </div>
    <div class="form-group">
        <hr>
        <div class="col-lg-offset-5 col-lg-5">
        <?if (!$model->isNewRecord) {?>
            <a class="btn btn-danger remove-user" href="/employee/delete/id/<?=$model->id;?>">Удалить</a>
        <?}?>
        <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </div>
</div>
<? $this->endWidget(); ?>


<div id="new-interval-item" class="hidden">
    <div class="row interval-row">
        <div class="col-xs-1">
            <button type="button" class="btn btn-danger remove-interval">-</button>
        </div>
        <div class="col-xs-5">
            <div class="col-md-12 col-lg-5">
                <select class="form-control start-hour-control" name="startHour">
                    <? for($hour = 0; $hour < 24; $hour++) {
                    echo "<option value='$hour'>" . ($hour < 10 ? "0$hour" : $hour) . "</option>";
                }?>
                </select>
            </div>
            <div class="col-md-12 col-lg-2 time-delimit">:</div>
            <div class="col-md-12 col-lg-5">
                <select class="form-control start-min-control" name="startMin">
                    <? for($min = 0; $min < 60; $min+=5) {
                    echo "<option value='$min'>" . ($min < 10 ? "0$min" : $min) . "</option>";
                }?>
                </select>
            </div>
        </div>
        <div class="col-xs-5">
            <div class="col-md-12 col-lg-5">
                <select class="form-control end-hour-control" name="endHour">
                    <? for($hour = 0; $hour < 24; $hour++) {
                    echo "<option value='$hour'>" . ($hour < 10 ? "0$hour" : $hour) . "</option>";
                }?>
                </select>
            </div>
            <div class="col-md-12 col-lg-2 time-delimit">:</div>
            <div class="col-md-12 col-lg-5 ">
                <select class="form-control end-min-control" name="endMin">
                    <? for($min = 0; $min < 60; $min+=5) {
                    echo "<option value='$min'>" . ($min < 10 ? "0$min" : $min) . "</option>";
                }?>
                </select>
            </div>
        </div>
        <div class="col-xs-1">
            <label class="checkbox-inline">
                <?=CHtml::checkBox("enable", 0);?>
            </label>
        </div>
    </div>
</div>
<script>
    $('.add-interval').click(function () {
        var day = $(this).data('day');
        var scheduleUniqId = parseInt($('#shedule-uniq-iq').val());
        var wrap = $('.day-interval-wrap[data-day=' + day + ']');

        $('#shedule-uniq-iq').val(scheduleUniqId + 1);

        var form = $('#new-interval-item>.row').clone();
        $.each($('select, input', form), function () {
            $(this).attr('name', 'schedule[' + day + '][' + scheduleUniqId + '][' + $(this).attr('name') + ']');
        });
        wrap.append(form);
        wrap.append('<hr class="margin-0">');
    });
    $('#worktime').on('click', '.remove-interval', function () {
        if (confirm('Удалить?')) {
            var row = $(this).closest('.row');
            row.next('hr').remove().end().remove();
        }
    });

    $('#user-update-form .remove-user').click(function(){
        return confirm('Удалить?');
    });

    $('#user-update-form').submit(function(){
        var defaultDate = new Date().clearTime();
        var hasError = false;
        $('#worktime .interval-row').removeClass('error');
        $.each($('#worktime .row'), function(){ //each по дням
            var $day = $(this);
            $.each($('.interval-row', $day), function () { //each по интервалам
                var $current = $(this);
                var currentDate = {
                    START:defaultDate.clone().set({minute:parseInt($('.start-min-control', $current).val()), hour:parseInt($('.start-hour-control', $current).val())}),
                    END:defaultDate.clone().set({minute:parseInt($('.end-min-control', $current).val()), hour:parseInt($('.end-hour-control', $current).val())})
                };
                if (currentDate.START.compareTo(currentDate.END) >= 0) { //начало и конец интервала совпадают
                    $current.addClass('error');
                    hasError = true;
                    return true;
                }
                $.each($('.interval-row', $day), function () { //сравниваем каждый с каждым
                    var $other = $(this);
                    if ($current.is($other)) {
                        return true;
                    }
                    var otherDate = {
                        START:defaultDate.clone().set({minute:parseInt($('.start-min-control', $other).val()), hour:parseInt($('.start-hour-control', $other).val())}),
                        END:defaultDate.clone().set({minute:parseInt($('.end-min-control', $other).val()), hour:parseInt($('.end-hour-control', $other).val())})
                    };

                    if (
                            (currentDate.START.equals(otherDate.START) && currentDate.END.equals(otherDate.END)) || //интервалы совпадают
                            (currentDate.START.compareTo(otherDate.START) > 0 && currentDate.START.compareTo(otherDate.END) < 0) || //начало внутри 2ого интервала
                            (currentDate.START.compareTo(otherDate.START) > 0 && currentDate.START.compareTo(otherDate.END) < 0) //конец внутри 2ого интервала
                        ) {
                        $current.addClass('error');
                        $other.addClass('error');
                        hasError = true;
                    }
                });
            });
        });
        if (hasError) {
            $.jGrowl("Ошибки в рабочих интервалах.");
            return false;
        }
        return true;
    });
</script>