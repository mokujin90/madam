<div class="col-xs-12 col-lg-6">
    <div class="form-group">
        <?= $form->labelEx($model,'param_imprint', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->radioButtonList($model, 'param_imprint', array(0=>'No imprint',1=>'External website as Contacts',2=>'Maintain a custom text for Contacts' ),array('class'=>'hide-radio toggle-input')); ?>
        </div>
    </div>
    <div class="radio-box" style="<?if($model->param_imprint==0):?>display: none;<?endif;?>">
        <div class="url-box"  style="<?if($model->param_imprint==1):?>display:block;<?else:?>display: none;<?endif;?>">
            <div class="form-group">
                <?= $form->labelEx($model,'url_imprint', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
                <div class="col-xs-12 col-sm-8">
                    <?php echo $form->textField($model,'url_imprint', array('class'=>'form-control')) ?>
                </div>
            </div>
        </div>

        <div class="textarea-box" style="<?if($model->param_imprint==2):?>display:block;<?else:?>display: none;<?endif;?>">
            <div class="form-group">
                <?= $form->labelEx($model,'address_imprint', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
                <div class="col-xs-12 col-sm-8">
                    <?php echo $form->textarea($model,'address_imprint', array('class'=>'form-control')) ?>
                </div>
            </div>

            <div class="form-group">
                <?= $form->labelEx($model,'text_imprint_add', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
                <div class="col-xs-12 col-sm-8">
                    <?php echo $form->textarea($model,'text_imprint_add', array('class'=>'form-control')) ?>
                </div>
            </div>
        </div>

    </div>
</div>