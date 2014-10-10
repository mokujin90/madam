<?php
/**
 *
 * @var AdminController $this
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'license-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'class'=>'form form-horizontal'
    )
)); ?>
<div class="col-sm-12">
    <div class="form-group">
        <label class="col-lg-1 control-label"><?=Yii::t('main','Язык')?></label>
        <div class="col-lg-3">
            <?= $form->dropDownList($model,'language_id',$language,array('class'=>"form-control"))?>
        </div>
    </div>
</div>

    <div class="col-lg-6">
        <button type="submit" value="1" name="save" class="btn btn-success"><?= Yii::t('main','Сохранить')?></button>
    </div>
<?php $this->endWidget(); ?>