<?
/**
 * @var $user User
 * @var $model Request
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
        'role'=>"form"
    ),
)); ?>
<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="/#mail" role="tab" data-toggle="tab">Почта</a></li>
    <li><a href="/#sms" role="tab" data-toggle="tab">SMS</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="mail">
        <?php echo CHtml::textArea('Notice[mail][text]','')?>
        <div>
            <button name="save" value="1" class="save btn btn-success" type="submit"><i class="icon-save"></i> <?=Yii::t('main',$model->isNewRecord? 'Создать' : 'Сохранить')?></button>
            <button href="<?=$this->createUrl('calendar/event',array('user_id'=>$model->user_id,'id'=>$model->id))?>"  class="btn btn-primary event" type="button"><?php echo Yii::t('main','Отменить')?></button>
        </div>

    </div>
    <div class="tab-pane" id="sms">
        <?php echo CHtml::textArea('Notice[sms][text]','')?>
        <div>
            <button name="save" value="1" class="save btn btn-success" type="submit"><i class="icon-save"></i> <?=Yii::t('main',$model->isNewRecord? 'Создать' : 'Сохранить')?></button>
            <button href="<?=$this->createUrl('calendar/event',array('user_id'=>$model->user_id,'id'=>$model->id))?>"  class="btn btn-primary event" type="button"><?php echo Yii::t('main','Отменить')?></button>
        </div>
    </div>
</div>
<?=CHtml::hiddenField('user_id',$model->user_id,array('id'=>'user_id'))?>
<?=CHtml::hiddenField('request_id',$model->id,array('id'=>'request_id'))?>

<?php $this->endWidget(); ?>
