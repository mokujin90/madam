<div class="col-xs-12 col-lg-6">

        <div class="form-group">
            <?= $form->labelEx($model,'show_reference', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->radioButtonList($model, 'show_reference', array('1'=>'Yes', '0'=>'No'),array('class'=>'hide-radio')); ?>
            </div>
        </div>

    <div class="radio-box"  style="<?if($model->show_reference==0):?>display: none;<?endif;?>">
        <div class="form-group">
            <?= $form->labelEx($model,'text_reference', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->textarea($model,'text_reference', array('class'=>'form-control')) ?>
            </div>
        </div>
    </div>


    <div class="form-group">
        <?= $form->labelEx($model,'show_reference_add', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->radioButtonList($model, 'show_reference_add', array('1'=>'Yes', '0'=>'No'),array('class'=>'hide-radio')); ?>
        </div>
    </div>
    <div class="radio-box" style="<?if($model->show_reference_add==0):?>display: none;<?endif;?>">
        <div class="form-group">
            <?= $form->labelEx($model,'request_reference_add', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->radioButtonList($model, 'request_reference_add', array('1'=>'Yes', '0'=>'No')); ?>
            </div>
        </div>

        <div class="form-group">
            <?= $form->labelEx($model,'text_reference_add', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->textarea($model,'text_reference_add', array('class'=>'form-control')) ?>
            </div>
        </div>
    </div>
</div>