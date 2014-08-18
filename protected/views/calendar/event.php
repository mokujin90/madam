<?
/* @var $this CalendarController */
Yii::app()->clientScript->registerScriptFile('/js/moment.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('/js/bootstrap-datetimepicker.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('/js/locales/bootstrap-datetimepicker.ru.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile('/css/bootstrap-datetimepicker.min.css');

Yii::app()->clientScript->registerScriptFile('/js/jquery.maskedinput.min.js', CClientScript::POS_HEAD);

Yii::app()->clientScript->registerScriptFile('/js/jquery.jgrowl.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile('/css/jquery.jgrowl.min.css');

Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('modal', 'event.init()', CClientScript::POS_END);
?>
<div>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'htmlOptions'=>array(
            'role'=>"form",
            'id'=>'create-event',
            'class' => 'validate-form col-xs-12'
        ),
    )); ?>

    <?
        $this->widget('WizardWidget',array('question'=>$question,'field'=>$field,'skin'=>'dialog','request'=>$model));
    ?>
    <div class="box datetime-setting col-xs-12">
        <div class="box-header green-background">
            <div class="title"><i class="icon-comments-alt"></i> <?=Yii::t('main','Время события')?></div>
        </div>
        <div class="row box-content">
            <div class="date box">
                <div class="controls">
                    <?=CHtml::label(Yii::t('main','Дата события:'),"datepicker")?>
                    <div class="datepicker-input-fb input-group" id="datepicker" data-date-format="DD/MM/YYYY">
                        <?=CHtml::textField('event[date]',$date['date_formatted'],array('class'=>'form-control','placeholder'=>Yii::t('main','Укажите дату')))?>
                        <span class="input-group-addon"><span data-date-icon="icon-calendar" data-time-icon="icon-time" class="icon-calendar"></span></span>
                    </div>
                </div>
            </div>
            <div class="date">
                <div class="controls">
                    <?=CHtml::label(Yii::t('main','Статус:'),"datepicker")?>
                    <?php echo CHtml::dropDownList('event[status]',$model->status,Request::$status,array('class'=>'form-control'))?>
                </div>
            </div>
            <div class="time box">
                <div class="controls">
                    <?=CHtml::label(Yii::t('main','Время начала:'),"")?>
                    <div class="timepicker-input-fb input-group" id="timepicker">
                        <?=CHtml::textField('event[start_time]',$date['start'],array('class'=>'form-control time-mask','data-format'=>"hh:mm",'placeholder'=>Yii::t('main','Время начала')))?>
                        <span class="input-group-addon"><span class="icon-time"></span></span>
                    </div>
                </div>
                <div class="controls">
                    <?=CHtml::label(Yii::t('main','Время конца:'),"")?>
                    <div class="timepicker-input-fb input-group" id="timepicker">
                        <?=CHtml::textField('event[end_time]',$date['end'],array('class'=>'form-control time-mask','data-format'=>"hh:mm",'placeholder'=>Yii::t('main','Время окончания')))?>
                        <span class="input-group-addon"><span class="icon-time"></span></span>
                    </div>
                </div>
                <?=CHtml::label(Yii::t('main','Комментарий:'),"")?>
                <?php echo CHtml::textArea('event[comment]',$model->comment,array('class'=>"form-control"))?>
            </div>
        </div>
    </div>
    <?=CHtml::hiddenField('user_id',$model->user_id,array('id'=>'user_id'))?>
    <?=CHtml::hiddenField('request_id',$model->id,array('id'=>'request_id'))?>
    <button name="save" value="1" class="save btn btn-success" type="submit"><i class="icon-save"></i> <?=Yii::t('main',$model->isNewRecord? 'Создать' : 'Сохранить')?></button>
    <button class="cancel btn btn-primary" type="button"><?=Yii::t('main','Отменить')?></button>
    <?if(!$model->isNewRecord):?>
        <button class="remove btn btn-danger" type="button"><?=Yii::t('main','Удалить')?></button>
        <?=CHtml::checkBox('event[is_block]',$model->is_block==1 ? true:false,array('value'=>1, 'uncheckValue'=>0,'id'=>'is_block_request'))?>
        <?php echo CHtml::label('Заблокировано','is_block_request')?>
    <?endif;?>

    <?php $this->endWidget(); ?>
</div>
