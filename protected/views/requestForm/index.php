<?php
    $this->layout = 'companyLayout';
    Yii::app()->clientScript->registerScriptFile('/js/main.js');
?>
<ul class="nav nav-tabs">
    <li class="active"><?=CHtml::link(Yii::t('main','Данные пользователя'),array('RequestForm/index','#'=>'user-data'),array('data-toggle'=>'tab'))?></li>
    <li class=""><?=CHtml::link(Yii::t('main','Вопросы'),array('RequestForm/index','#'=>'questions'),array('data-toggle'=>'tab'))?></li>
</ul>

<!-- Tab panes -->
<?php $form=$this->beginWidget('CActiveForm',array(
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role'=>"form")
)); ?>
    <div class="tab-content">

        <div class="tab-pane active" id="user-data">
            <?php $this->renderPartial('_user-data',array(
                'fields'=>$fields,
            )); ?>
        </div>
        <div class="tab-pane" id="questions">
            <?php $this->renderPartial('_questions',array(
                'questions'=>$questions,
            )); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>
<div class="hidden" id="new-question-item">
    <div class="active tab-pane">
        <?=CHtml::hiddenField("id",0)?>
        <div class="col-xs-12">
            <div class="box" style="margin-bottom: 0">
                <div class="box-header orange-background">
                    <div class="title"><?=Yii::t('main','Вопрос')?></div>
                    <div class="actions">
                        <a class="add-answer btn btn-xs btn-link" href="#"><i class="icon-plus"></i> <?= Yii::t('main','Добавить ответ')?></a>
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 control-label"><?=Yii::t('main','Вопрос')?>:</label>
                        <div class="col-xs-10 col-sm-6">
                            <?=CHtml::textField('text','',array('class'=>'form-control'));?>
                        </div>
                        <div class="col-xs-2 col-sm-2">
                            <div class="btn has-popover pull-right" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="left" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 control-label"><?=Yii::t('main','Подсказка к вопросу')?>:</label>
                        <div class="col-xs-10 col-sm-6">
                            <?= CHtml::textArea("hint",'',array('class'=>'form-control','rows'=>3))?>
                        </div>
                        <div class="col-xs-2 col-sm-2">
                            <div class="btn has-popover pull-right" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="left" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <label class="col-xs-12 control-label text-label-important">
                                <?=CHtml::radioButton("type",true,array('value'=>'radio'))?>
                                <?=Yii::t('main','Только один ответ')?>
                            </label>
                            <label class="col-xs-12 control-label text-label-important">
                                <?=CHtml::radioButton("type",false,array('value'=>'check'))?>
                                <?=Yii::t('main','Несколько ответов')?>
                            </label>
                        </div>
                    </div>
                    <div class="answers">
                        <?=CHtml::hiddenField('',0,array('class'=>'count-answer','disabled'=>true))?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hidden" id="new-answer-item">
    <div class="answer box" style="margin-bottom: 0">
        <?=CHtml::hiddenField("id",'0');?>
        <div class="box-header">
            <div class="title"><?=Yii::t('main','Ответ')?></div>
            <div class="actions">
                <a class="remove-answer btn btn-xs btn-link" href="#"><i class="icon-remove"></i> <?=Yii::t('main','Удалить ответ')?></a>
                <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
            </div>
        </div>
        <div class="box-content col-xs-12">
            <div class="form-group">
                <label class="col-xs-12"><?=Yii::t('main','Ответ')?></label>

                <div class="col-xs-10">
                    <?=CHtml::textField("text",'',array('class'=>'form-control'))?>
                </div>
                <div class="col-xs-2">
                    <div class="btn has-popover pull-right" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="left" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-12 col-sm-6">
                    <label>MIN</label>
                    <?=CHtml::textField("min",'',array('class'=>'form-control'))?>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <label>ABBR</label>
                    <?=CHtml::textField("abbr",'',array('class'=>'form-control'))?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <label><?=Yii::t('main','Примечания')?></label>
                </div>
                <div class="col-xs-6">
                    <?=CHtml::textArea("hint",'',array('class'=>"form-control","rows"=>3))?>
                </div>
                <div class="col-xs-2">
                    <div class="btn has-popover pull-right" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="left" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                </div>
                <div class="col-xs-4">
                    <div class="btn-group dropdown">
                        <button class="btn dropdown-toggle" data-toggle="dropdown" style="margin-bottom:5px">
                            <i class="icon-cloud-upload"></i>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu answer-icon">
                            <?foreach(Answer::$icon as $icon):?>
                                <li><a href="#"><i class="<?=$icon?>"></i></a></li>
                            <?endforeach;?>
                        </ul>
                        <?=CHtml::hiddenField("icon",'icon-cloud-upload',array('class'=>'model-icon'))?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hidden" id="new-field-item">
    <div class="form-group">
        <?= CHtml::hiddenField('id','0')?>
        <div class="col-xs-12 col-sm-1">
            <button type="button" class="col-xs-12 btn btn-primary up-field">&uarr;</button>
        </div>
        <div class="col-xs-12 col-sm-1">
            <div type="button" class="col-xs-12 btn btn-primary down-field">&darr;</div>
        </div>
        <div class="col-xs-12 col-sm-1">
            <button type="button" class="col-xs-12 btn btn-danger remove-field">-</button>
        </div>
        <div class="col-xs-12 col-sm-5">
            <?= CHtml::textField('name','',array('class'=>"form-control"))?>
        </div>
        <div class="col-xs-12 col-sm-4">
            <?= CHtml::dropDownList('type','enabled', CompanyField::$params,array('class'=>'form-control'));?>
        </div>
    </div>
</div>
