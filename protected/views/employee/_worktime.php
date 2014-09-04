<?
/**
 * @var $model User
 */
    $scheduleArray = $model->getScheduleByDay();
    $sheduleId = User::model()->getSheduleId($scheduleArray);
    $shedule2answer = Shedule2Answer::getByShedule($sheduleId);
    $tree = Shedule2Answer::getTreeView($shedule2answer);
?>
<div class="col-xs-12 col-lg-8">
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
                                <div class="col-xs-12 col-sm-1">
                                    <button type="button" class="col-xs-12 btn btn-danger remove-interval"><span class="hidden-xs">-</span><span class="hidden-sm hidden-md hidden-lg">Удалить</span></button>
                                </div>
                                <div class="col-xs-6 col-sm-5">
                                    <div class="col-sm-12 col-md-5">
                                        <select class="form-control start-hour-control" name="schedule[<?=$i;?>][<?=$scheduleUniqId;?>][startHour]">
                                            <? for($hour = 0; $hour < 24; $hour++) {
                                            echo "<option value='$hour' " . ($hour == $scheduleRow['startHour'] ? 'selected' : '') . ">" . ($hour < 10 ? "0$hour" : $hour) . "</option>";
                                        }?>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-2 time-delimit">:</div>
                                    <div class="col-sm-12 col-md-5">
                                        <select class="form-control start-min-control" name="schedule[<?=$i;?>][<?=$scheduleUniqId;?>][startMin]">
                                            <? for($min = 0; $min < 60; $min+=5) {
                                            echo "<option value='$min' " . ($min == $scheduleRow['startMin'] ? 'selected' : '') . ">" . ($min < 10 ? "0$min" : $min) . "</option>";
                                        }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-5">
                                    <div class="col-sm-12 col-md-5">
                                        <select class="form-control end-hour-control" name="schedule[<?=$i;?>][<?=$scheduleUniqId;?>][endHour]">
                                            <? for($hour = 0; $hour < 24; $hour++) {
                                            echo "<option value='$hour' " . ($hour == $scheduleRow['endHour'] ? 'selected' : '') . ">" . ($hour < 10 ? "0$hour" : $hour) . "</option>";
                                        }?>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-2 time-delimit">:</div>
                                    <div class="col-sm-12 col-md-5">
                                        <select class="form-control end-min-control" name="schedule[<?=$i;?>][<?=$scheduleUniqId;?>][endMin]">
                                            <? for($min = 0; $min < 60; $min+=5) {
                                            echo "<option value='$min' " . ($min == $scheduleRow['endMin'] ? 'selected' : '') . ">" . ($min < 10 ? "0$min" : $min) . "</option>";
                                        }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <label class="checkbox-inline">
                                        <?=CHtml::checkBox("schedule[$i][$scheduleUniqId][enable]", !empty($scheduleRow['enable']));?>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="box box-nomargin box-collapsed" style="margin-bottom:0">
                                    <div class="box-header box-header-small muted-background">
                                        <div class="title">Доп. настройки</div>
                                        <div class="actions">
                                            <a class="btn box-collapse btn-link btn-xs" href="#"><i></i></a>
                                        </div>
                                    </div>
                                    <div class="box-content">
                                        <div class="col-xs-12 clearfix">
                                            <div class="form-group">
                                                <label class="col-xs-4 control-label">Ответы, одобрены для графика</label>
                                                <div class="col-xs-8">
                                                    <div class="radio">
                                                        <?php echo CHtml::radioButton("schedule[$i][$scheduleUniqId][all_answers]",$scheduleRow['all_answers']==1?true:false,array('value'=>1,'class'=>'option_all_answer user-type-answer'))?>
                                                        <?php echo CHtml::label(Yii::t('main','Все ответы'),'option_all_answer');?>
                                                    </div>
                                                    <div class="radio">
                                                        <?php echo CHtml::radioButton("schedule[$i][$scheduleUniqId][all_answers]",$scheduleRow['all_answers']!=1?true:false,array('value'=>0,'class'=>'option_all_answer user-type-answer'))?>
                                                        <?php echo CHtml::label(Yii::t('main','Определенные ответы'),'optionsRadios2');?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user-answer" style="<?if($scheduleRow['all_answers']==1):?>display: none;<?endif?>">
                                                <?foreach($question as $item):?>
                                                <div class="form-group">
                                                    <label class="col-xs-4 control-label"><?=$item->text?></label>
                                                    <div class="col-xs-8">
                                                        <?foreach($item['answers'] as $answer):?>
                                                        <div class="checkbox">
                                                            <label>
                                                                <?=CHtml::checkBox("schedule[$i][$scheduleUniqId][schedule2answer][$answer->id]",isset($tree[$answer->id][$scheduleRow['id']])?true:false)?><?=$answer->text?>
                                                            </label>
                                                        </div>
                                                        <?endforeach?>
                                                    </div>
                                                </div>
                                                <?endforeach;?>
                                            </div>
                                        </div>
                                    </div>
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
<div class="col-xs-12 col-lg-4">
    <h4>Рабочее время</h4>
                        <span>
                            Вставьте здесь свои рабочие часы в неделю, что. нажав на добавить работу в то время, день недели.
                            Нажав на удалить соответствующие рабочие часы.
                            Если вы хотите поделиться работу для онлайн-бронирования назначения, нажмите в последнем столбце
                            одноименной флажок.
                        </span>
</div>