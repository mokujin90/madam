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
        'model'=>$model,
    )); ?>
    </div>
    <div class="tab-pane" id="types">
        <?php $this->renderPartial('_types',array(
        'form'=>$form,
        'model'=>$model,
        'question'=>$question,
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
</div>