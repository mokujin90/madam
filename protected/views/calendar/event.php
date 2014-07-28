<?
/* @var $this CalendarController */
Yii::app()->clientScript->registerScriptFile('/js/moment.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('/js/bootstrap-datetimepicker.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile('/css/bootstrap-datetimepicker.min.css');
Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('modal', 'event.init()', CClientScript::POS_READY);
?>
<div>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'htmlOptions'=>array(
            'role'=>"form",
            'id'=>'create-event'
        ),
    )); ?>

    <?
        $this->widget('WizardWidget',array('question'=>$question,'field'=>$field,'skin'=>'dialog'));
    ?>
    <div class="box datetime-setting">
        <div class="box-header green-background">
            <div class="title"><i class="icon-comments-alt"></i> <?=Yii::t('main','Время события')?></div>
        </div>
        <div class="row box-content box-no-padding">
            <div class="date box">
                <div class="controls">
                    <?=CHtml::label(Yii::t('main','Дата события:'),"datepicker")?>
                    <div class="datepicker-input input-group" id="datepicker">
                        <?=CHtml::textField('event[date]','',array('class'=>'form-control','data-format'=>"YYYY-MM-DD",'placeholder'=>Yii::t('main','Укажите дату')))?>
                        <span class="input-group-addon"><span data-date-icon="icon-calendar" data-time-icon="icon-time" class="icon-calendar"></span></span>
                    </div>
                </div>
            </div>
            <div class="time box">
                <div class="controls">
                    <?=CHtml::label(Yii::t('main','Время начала:'),"")?>
                    <div class="timepicker-input input-group" id="timepicker">
                        <?=CHtml::textField('event[start_time]','',array('class'=>'form-control','data-format'=>"HH:mm",'placeholder'=>Yii::t('main','Время начала')))?>
                        <span class="input-group-addon"><span class="icon-time"></span></span>
                    </div>
                </div>
                <div class="controls">
                    <?=CHtml::label(Yii::t('main','Время конца:'),"")?>
                    <div class="timepicker-input input-group" id="timepicker">
                        <?=CHtml::textField('event[end_time]','',array('class'=>'form-control','data-format'=>"HH:mm",'placeholder'=>Yii::t('main','Время окончания')))?>
                        <span class="input-group-addon"><span class="icon-time"></span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button name="save" value="1" class="save btn btn-success" type="submit"><i class="icon-save"></i> <?=Yii::t('main',$model->isNewRecord? 'Создать' : 'Сохранить')?></button>
    <button class="cancel btn btn-primary" type="button"><?=Yii::t('main','Отменить')?></button>

    <?php $this->endWidget(); ?>
</div>
