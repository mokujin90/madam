
    <div class="col-xs-12 col-lg-6">
        <div class="form-group">
            <?= $form->labelEx($model,'show_condition', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->radioButtonList($model, 'show_condition', array('1'=>Yii::t('main','Да'), '0'=>Yii::t('main','Нет')),array('class'=>'hide-radio')); ?>
            </div>
        </div>
    <div class="radio-box" style="<?if($model->show_condition==0):?>display: none;<?endif;?>">
        <div class="form-group">
            <?= $form->labelEx($model,'note_condition', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->textarea($model,'note_condition', array('class'=>'form-control')) ?>
            </div>
        </div>

        <div class="form-group">
            <?= $form->labelEx($model,'text_condition', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->textarea($model,'text_condition', array('class'=>'form-control')) ?>
            </div>
        </div>
    </div>
</div>