<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'license-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'class'=>'form form-horizontal'
    )
)); ?>
    <?php $this->renderPartial('/admin/_license', array('model'=>$model,'form'=>$form, 'style' => '')); ?>

    <?php $this->renderPartial('/admin/_price', array('model'=>$model,'form'=>$form)); ?>

<div class="col-lg-6">
    <button type="submit" value="1" name="save" class="btn btn-success"><?=$model->isNewRecord ? 'Create' : 'Save'?></button>
</div>
<?php $this->endWidget(); ?>

