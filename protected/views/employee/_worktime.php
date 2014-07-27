<?$scheduleArray = $model->getScheduleByDay();?>
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