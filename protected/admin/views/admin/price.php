<?
/**
 * @var $this AdminCompanyController
 * @var $current Company2License
 * @var $model License
 * @var $current['license'] License
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'license-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'class'=>'form form-horizontal'
    )
)); ?>

    <?php $this->renderPartial('/admin/_price', array('model'=>$model,'form'=>$form)); ?>

    <div class="col-lg-6">
        <button type="submit" value="1" name="save" class="btn btn-success"><?= Yii::t('main','Сохранить')?></button>
    </div>
<?php $this->endWidget(); ?>