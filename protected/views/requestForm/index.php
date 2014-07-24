<?php
    $this->layout = 'companyLayout';
    Yii::app()->clientScript->registerScriptFile('/js/main.js');
?>
<ul class="nav nav-tabs">
    <li class=""><a href="http://terminland.art-kos.com/general_settings/user/#user-data" data-toggle="tab">Данные пользователя</a></li>
    <li class="active"><a href="http://terminland.art-kos.com/general_settings/user/#questions" data-toggle="tab">Вопросы</a></li>
</ul>

<!-- Tab panes -->
<?php $form=$this->beginWidget('CActiveForm',array(
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role'=>"form")
)); ?>
    <div class="tab-content">

        <div class="tab-pane " id="user-data">
            <?php $this->renderPartial('_user-data',array(
                'questions'=>$questions,
            )); ?>
        </div>
        <div class="tab-pane active" id="questions">
            <?php $this->renderPartial('_questions',array(
                'questions'=>$questions,
            )); ?>

    </div>
<?php $this->endWidget(); ?>
<div class="hidden" id="new-question-item">
    <div class="active tab-pane">
        <?=CHtml::hiddenField("id",0)?>
        <nav class="navbar navbar-default">
            <div class="navbar-brand"><?=Yii::t('main','Вопрос')?></div>
            <button type="button" class="add-answer btn btn-primary pull-right"><?= Yii::t('main','Добавить ответ')?></button>
        </nav>
        <div class="form-group">
            <label class="col-xs-12 col-sm-4 control-label"><?=Yii::t('main','Вопрос')?>:</label>
            <div class="col-xs-10 col-sm-7">
                <?=CHtml::textField('text','',array('class'=>'form-control'));?>
            </div>
            <div class="col-xs-1">
                <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 col-xs-12 control-label"><?=Yii::t('main','Подсказка к вопросу')?>:</label>
            <div class="col-xs-10 col-sm-7">
                <?= CHtml::textArea("hint",'',array('class'=>'form-control','rows'=>3))?>
            </div>
            <div class="col-xs-1">
                <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
            </div>
        </div>
        <div class="form-group">
            <div class="radio col-xs-offset-4 col-xs-8">
                <label>
                    <?=CHtml::radioButton("type",true,array('value'=>'radio'))?>
                    <?=Yii::t('main','Возможно выбрать только один ответ')?>
                </label>
            </div>
            <div class="radio col-xs-offset-4 col-xs-8">
                <label>
                    <?=CHtml::radioButton("type",false,array('value'=>'check'))?>
                    <?=Yii::t('main','Возможно выбрать несколько ответов')?>
                </label>
            </div>
        </div>
        <div class="answers">
            <?=CHtml::hiddenField('',0,array('class'=>'count-answer','disabled'=>true))?>
        </div>
    </div>
</div>
<div class="hidden" id="new-answer-item">
    <div class="answer">
        <?=CHtml::hiddenField("id",'0');?>
        <nav class="navbar navbar-default">
            <div class="navbar-brand"><?=Yii::t('main','Ответ')?></div>
            <button type="button" class="remove-answer btn btn-warning pull-right"><?=Yii::t('main','Удалить ответ')?></button>
        </nav>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-5">
                    <label class="col-xs-2 control-label"><?=Yii::t('main','Ответ')?></label>
                </div>
                <div class="col-xs-2 col-xs-offset-2">
                    <label class="control-label"><?=Yii::t('main','Время, мин')?></label>
                </div>
            </div>

            <div class="col-xs-6">
                <?=CHtml::textField("text",'',array('class'=>'form-control'))?>
            </div>
            <div class="col-xs-1">
                <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
            </div>
            <div class="col-xs-3">
                <div class="">
                    MIN
                    <?=CHtml::textField("min",'',array('class'=>'form-control'))?>
                    ABBR
                    <?=CHtml::textField("abbr",'',array('class'=>'form-control'))?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label><?=Yii::t('main','Примечания')?></label>
            </div>
            <div class="col-xs-6">
                <?=CHtml::textArea("hint",'',array('class'=>"form-control","rows"=>3))?>
            </div>
            <div class="col-xs-1">
                <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
            </div>
            <div class="col-xs-2">
                <button type="button" class="btn btn-default"><?=Yii::t('main','Иконка')?></button>
            </div>
        </div>
    </div>
</div>
