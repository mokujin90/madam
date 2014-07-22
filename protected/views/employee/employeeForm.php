<?php
/* @var $this SiteController */
$this->layout = 'companyLayout';
?>

<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="http://terminland.art-kos.com/schedules_settings/schedules/#personal" role="tab" data-toggle="tab">Линые данные</a></li>
    <li class=""><a href="http://terminland.art-kos.com/schedules_settings/schedules/#worktime" role="tab" data-toggle="tab">Рабочее время</a></li>
    <li><a href="http://terminland.art-kos.com/schedules_settings/schedules/#types" role="tab" data-toggle="tab">Типы назначений</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="personal">
    <div class="col-xs-12 col-sm-8">
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="input1" class="col-xs-4 control-label">Имя</label>
                <div class="col-xs-4">
                    <input name="employer_name" type="text" class="form-control" id="input1" value="Natalia">
                </div>
            </div>
            <div class="form-group">
                <label for="input2" class="col-xs-4 control-label">Фамилия</label>
                <div class="col-xs-4">
                    <input name="employer_secondname" type="text" class="form-control" id="input2" value="Demyanenko">
                </div>
            </div>
            <div class="form-group">
                <label for="input3" class="col-xs-4 control-label">Описание</label>
                <div class="col-xs-4">
                    <input name="employer_description" type="text" class="form-control" id="input3" placeholder="Специальность">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-4 control-label">Длительность приема</label>
                <div class="col-xs-4">
                    <select name="employer_reception_duration" class="form-control">
                        <option>10 минут</option>
                        <option>15 минут</option>
                        <option>20 минут</option>
                        <option>30 минут</option>
                        <option>60 минут</option>
                        <option>Ручной</option>
                    </select>
                </div>
                <div class="col-xs-1">
                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i> Подробнее</div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-4 control-label">Длительность назначений</label>
                <div class="col-xs-4">
                    <select name="employer_appointments_duration" class="form-control">
                        <option>10 минут</option>
                        <option>15 минут</option>
                        <option>20 минут</option>
                        <option>30 минут</option>
                        <option>60 минут</option>
                        <option>Индивидуально</option>
                        <option>Автоматично</option>
                    </select>
                </div>
                <div class="col-xs-1">
                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i> Подробнее</div>
                </div>
            </div>
            <div class="form-group">
                <label for="input4" class="col-xs-4 control-label">Синхронизация с CalDAV</label>
                <div class="col-xs-4">
                    <input name="calldav" type="text" class="form-control" id="input4">
                </div>
                <div class="col-xs-1">
                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i> Подробнее</div>
                </div>
            </div>
            <div class="form-group">
                <hr>
                <div class="col-lg-offset-5 col-lg-5">
                    <button type="submit" class="btn btn-danger">Отменить</button>
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $dayNames = array("Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье");
$scheduleArray = array(
    0 => array(
        array('startHour' => 12, 'startMin' => 30, 'endHour' =>18, 'endMin' =>0, 'enable' => false),
        array('startHour' => 18, 'startMin' => 30, 'endHour' =>20, 'endMin' =>0, 'enable' => true),
    ),
    4 => array(
        array('startHour' => 9, 'startMin' => 0, 'endHour' =>10, 'endMin' =>0, 'enable' => true),
        array('startHour' => 15, 'startMin' => 30, 'endHour' =>20, 'endMin' =>0, 'enable' => true),
        array('startHour' => 22, 'startMin' => 30, 'endHour' =>23, 'endMin' =>0, 'enable' => true),
    )
);

?>
<div class="tab-pane" id="worktime">
    <div class="col-xs-12 col-sm-8">
        <?php
            $scheduleUniqId = 0;
            for($i = 0; $i < 7; $i++) {
        ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box" style="margin-bottom:0">
                    <div class="box-header blue-background">
                        <div class="title"><?=$dayNames[$i];?></div>
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
                            <hr class="margin-10">
                            <?php if(isset($scheduleArray[$i])) foreach($scheduleArray[$i] as $scheduleRow){?>
                            <div class="row">
                                <div class="col-xs-1">
                                    <button type="button" class="btn btn-danger remove-interval">-</button>
                                </div>
                                <div class="col-xs-5">
                                    <div class="col-md-12 col-lg-5">
                                        <select class="form-control" name="schedule[<?=$i;?>][<?=$scheduleUniqId;?>][startHour]">
                                            <?php for($hour = 0; $hour < 24; $hour++) {
                                                echo "<option value='$hour' " . ($hour == $scheduleRow['startHour'] ? 'selected' : '') . ">" . ($hour < 10 ? "0$hour" : $hour) . "</option>";
                                            }?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-lg-2 time-delimit">:</div>
                                    <div class="col-md-12 col-lg-5">
                                        <select class="form-control" name="schedule[<?=$i;?>][<?=$scheduleUniqId;?>][startMin]">
                                            <?php for($min = 0; $min < 60; $min+=5) {
                                                echo "<option value='$min' " . ($min == $scheduleRow['startMin'] ? 'selected' : '') . ">" . ($min < 10 ? "0$min" : $min) . "</option>";
                                            }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-5">
                                    <div class="col-md-12 col-lg-5">
                                        <select class="form-control" name="schedule[<?=$i;?>][<?=$scheduleUniqId;?>][endHour]">
                                            <?php for($hour = 0; $hour < 24; $hour++) {
                                                echo "<option value='$hour' " . ($hour == $scheduleRow['endHour'] ? 'selected' : '') . ">" . ($hour < 10 ? "0$hour" : $hour) . "</option>";
                                            }?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-lg-2 time-delimit">:</div>
                                    <div class="col-md-12 col-lg-5 ">
                                        <select class="form-control" name="schedule[<?=$i;?>][<?=$scheduleUniqId;?>][endMin]">
                                            <?php for($min = 0; $min < 60; $min+=5) {
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
                            <hr class="margin-10">
                            <?php $scheduleUniqId++; }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
        <input type="hidden" id="shedule-uniq-iq" value="<?=$scheduleUniqId;?>"/>

        <div class="row">
            <hr>
            <div class="col-lg-offset-8 col-lg-4">
                <button type="submit" class="btn btn-danger">Отменить</button>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </div>
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
        <form class="form-horizontal" role="form">
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
        </form>
    </div>
    <div class="col-xs-12 col-sm-4">

    </div>
</div>
</div>

<div id="new-interval-item" class="hidden">
    <div class="row" id="super">
        <div class="col-xs-1">
            <button type="button" class="btn btn-danger remove-interval">-</button>
        </div>
        <div class="col-xs-5">
            <div class="col-md-12 col-lg-5">
                <select class="form-control" name="startHour">
                    <?php for($hour = 0; $hour < 24; $hour++) {
                    echo "<option value='$hour'>" . ($hour < 10 ? "0$hour" : $hour) . "</option>";
                }?>
                </select>
            </div>
            <div class="col-md-12 col-lg-2 time-delimit">:</div>
            <div class="col-md-12 col-lg-5">
                <select class="form-control" name="startMin">
                    <?php for($min = 0; $min < 60; $min+=5) {
                    echo "<option value='$min'>" . ($min < 10 ? "0$min" : $min) . "</option>";
                }?>
                </select>
            </div>
        </div>
        <div class="col-xs-5">
            <div class="col-md-12 col-lg-5">
                <select class="form-control" name="endHour">
                    <?php for($hour = 0; $hour < 24; $hour++) {
                    echo "<option value='$hour'>" . ($hour < 10 ? "0$hour" : $hour) . "</option>";
                }?>
                </select>
            </div>
            <div class="col-md-12 col-lg-2 time-delimit">:</div>
            <div class="col-md-12 col-lg-5 ">
                <select class="form-control" name="endMin">
                    <?php for($min = 0; $min < 60; $min+=5) {
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
        wrap.append('<hr class="margin-10">');
    });
    $('#worktime').on('click', '.remove-interval', function () {
        if (confirm('Удалить?')) {
            var row = $(this).closest('.row');
            row.next('hr').remove().end().remove();
        }
    });
</script>