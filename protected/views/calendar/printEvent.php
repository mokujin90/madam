<?
/* @var $this CalendarController */
Yii::app()->clientScript->registerScriptFile('/js/extension/jquery.print.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('modal', 'modal.init()', CClientScript::POS_END);

?>
<div>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'htmlOptions'=>array(
            'role'=>"form",
            'id'=>'create-event',
            'class' => 'validate-form'
        ),
    )); ?>
    <?
        $this->widget('WizardWidget',array('question'=>$question,'field'=>$field,'skin'=>'print','request'=>$model));
    ?>
    <div class="box datetime-setting col-xs-12">
        <div class="box-header green-background">
            <div class="title"><i class="icon-comments-alt"></i> <?=Yii::t('main','Время события')?></div>
        </div>
        <div class="row box-content">
            <div class="date box">
                <div class="controls">
                    <?=CHtml::label(Yii::t('main','Дата события:'),"datepicker")?>
                    <?=$date['date_formatted']?>
                </div>
            </div>
            <div class="time box">
                <div class="controls">
                    <?=CHtml::label(Yii::t('main','Статус:'),"")?>
                    <?=Request::$status[$model->status]?>
                </div>
                <div class="controls">
                    <?=CHtml::label(Yii::t('main','Время начала:'),"")?>
                    <?=$date['start']?>
                </div>
                <div class="controls">
                    <?=CHtml::label(Yii::t('main','Время конца:'),"")?>
                    <?=$date['end']?>
                </div>
                <?=CHtml::label(Yii::t('main','Комментарий:'),"")?>
                <?=$model->comment?>
            </div>
        </div>
    </div>
    <?=CHtml::hiddenField('user_id',$model->user_id,array('id'=>'user_id'))?>
    <?=CHtml::hiddenField('request_id',$model->id,array('id'=>'request_id'))?>
    <button href="<?=$this->createUrl('calendar/event',array('user_id'=>$model->user_id,'id'=>$model->id,'edit'=>1))?>" name="save" value="1" class="edit event btn btn-success" type="button"><i class="icon-cogs"></i> <?=Yii::t('main','Изменить даты')?></button>
    <button name="print" value="1" class="print btn btn-success" type="button"><i class=" icon-print"></i> <?php echo Yii::t('main','Распечатать')?></button>
    <button class="cancel btn btn-primary" type="button"><?=Yii::t('main','Отменить')?></button>
    <?php $this->endWidget(); ?>
</div>