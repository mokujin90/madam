<?php
    $this->layout = 'companyLayout';
    Yii::app()->clientScript->registerScriptFile('/js/main.js');
    Yii::app()->clientScript->registerScriptFile('/js/datejs/core.js');
    Yii::app()->clientScript->registerScriptFile('/js/datejs/date.js');
?>

<?if(!$model->isNewRecord && empty($model->baikal_user_id)):?>
<div class="alert alert-danger alert-dismissable">
    <h4>
        <i class="icon-warning-sign"></i>
        <?=Yii::t('main','CalDav Error')?>
    </h4>
    <?=Yii::t('main','CalDav для данного пользователя, по каким-то причинам не был создан. Для избежания возможных проблем пересоздайте пользователя или обратитесь к администрации.')?>
</div>
<?endif?>

<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="/#personal" role="tab" data-toggle="tab">Личные данные</a></li>
    <li class=""><a href="/#worktime" role="tab" data-toggle="tab">Рабочее время</a></li>
    <li><a href="/#types" role="tab" data-toggle="tab">Типы назначений</a></li>
</ul>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-update-form',
    'enableClientValidation'=>false,
    'htmlOptions' => array('class' => 'form-horizontal')
)); ?>
<div class="tab-content">
    <div class="tab-pane active" id="personal">
        <?php $this->renderPartial('_personal',array(
        'form'=>$form,
        'model'=>$model,
    )); ?>
    </div>
    <div class="tab-pane" id="worktime">
        <?php $this->renderPartial('_worktime',array(
        'form'=>$form,
        'model'=>$model,        'question'=>$question,

    )); ?>
    </div>
    <div class="tab-pane" id="types">
        <?php $this->renderPartial('_types',array(
        'form'=>$form,
        'model'=>$model,
        'question'=>$question,
        'user2answer'=>$user2answer
    )); ?>
    </div>
</div>
<div class="">
    <hr>
    <div class="col-lg-offset-5 col-lg-5">
    <?if (!$model->isNewRecord) {?>
        <a class="btn btn-danger remove-user" href="/employee/delete/id/<?=$model->id;?>">Удалить</a>
    <?}?>
    <button type="submit" class="btn btn-success">Сохранить</button>
    </div>
</div>
<? $this->endWidget(); ?>


<div id="new-interval-item" class="hidden">
    <div class="row interval-row">
        <div class="col-xs-12 col-sm-1">
            <button type="button" class="col-xs-12 btn btn-danger remove-interval"><span class="hidden-xs">-</span><span class="hidden-sm hidden-md hidden-lg">Удалить</span></button>
        </div>
        <div class="col-xs-6 col-sm-5">
            <div class="col-sm-12 col-md-5">
                <select class="form-control start-hour-control" name="startHour">
                    <? for($hour = 0; $hour < 24; $hour++) {
                    echo "<option value='$hour'>" . ($hour < 10 ? "0$hour" : $hour) . "</option>";
                }?>
                </select>
            </div>
            <div class="col-sm-12 col-md-2 time-delimit">:</div>
            <div class="col-sm-12 col-md-5">
                <select class="form-control start-min-control" name="startMin">
                    <? for($min = 0; $min < 60; $min+=5) {
                    echo "<option value='$min'>" . ($min < 10 ? "0$min" : $min) . "</option>";
                }?>
                </select>
            </div>
        </div>
        <div class="col-xs-6 col-sm-5">
            <div class="col-sm-12 col-md-5">
                <select class="form-control end-hour-control" name="endHour">
                    <? for($hour = 0; $hour < 24; $hour++) {
                    echo "<option value='$hour'>" . ($hour < 10 ? "0$hour" : $hour) . "</option>";
                }?>
                </select>
            </div>
            <div class="col-sm-12 col-md-2 time-delimit">:</div>
            <div class="col-sm-12 col-md-5">
                <select class="form-control end-min-control" name="endMin">
                    <? for($min = 0; $min < 60; $min+=5) {
                    echo "<option value='$min'>" . ($min < 10 ? "0$min" : $min) . "</option>";
                }?>
                </select>
            </div>
        </div>
        <div class="col-sm-1">
            <label class="checkbox-inline">
                <?=CHtml::checkBox("enable", 0);?>
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
                                <?php echo CHtml::radioButton("all_answers",false,array('value'=>1,'class'=>'option_all_answer user-type-answer'))?>
                                <?php echo CHtml::label(Yii::t('main','Все ответы'),'option_all_answer');?>
                            </div>
                            <div class="radio">
                                <?php echo CHtml::radioButton("all_answers",true,array('value'=>0,'class'=>'option_all_answer user-type-answer'))?>
                                <?php echo CHtml::label(Yii::t('main','Определенные ответы'),'optionsRadios2');?>
                            </div>
                        </div>
                    </div>
                    <div class="user-answer"">
                        <?foreach($question as $item):?>
                            <div class="form-group">
                                <label class="col-xs-4 control-label"><?=$item->text?></label>
                                <div class="col-xs-8">
                                    <?foreach($item['answers'] as $answer):?>
                                        <div class="checkbox">
                                            <label>
                                                <?=CHtml::checkBox("schedule2answer][$answer->id",isset($tree[$answer->id])?true:false)?><?=$answer->text?>
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
</div>