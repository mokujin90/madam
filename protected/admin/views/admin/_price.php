<div class="box">
    <div class="box-header green-background">
        <div class="title"><div class="icon-dollar"></div> <?php echo Yii::t('main','Стоимость')?></div>
    </div>
    <div class="box-content">
        <div class="form-group">
            <?php echo $form->labelEx($model,'price',array('class'=>'col-md-2 control-label')); ?>
            <div class="col-md-5">
                <?php echo $form->textField($model,'price',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'price'); ?>
            </div>
        </div>
    </div>
</div>