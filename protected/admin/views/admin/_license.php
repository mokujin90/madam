<?php
/* @var $this LicenseController */
/* @var $model License */
/* @var $form CActiveForm */
?>
<div class="form-group" id="edit-license" style="<?=$style?>">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header blue-background">
                <div class="title"><div class="icon-edit"></div><?php echo Yii::t('main','Редактирование лицензии')?></div>
            </div>
            <div class="box-content">
                    <?php echo $form->errorSummary($model); ?>
                    <?php echo CHtml::hiddenField('url_referrer',Yii::app()->request->urlReferrer)?>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'question',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-5">
                            <?php echo $form->textField($model,'question',array('size'=>11,'maxlength'=>11,'class'=>'form-control')); ?>
                            <?php echo $form->error($model,'question'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'control_dialog',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-10"><div class="checkbox">
                            <?php echo $form->checkBox($model,'control_dialog',array('value' => '1', 'uncheckValue'=>'0')); ?>
                            <?php echo $form->error($model,'control_dialog'); ?>
                        </div></div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'group_event',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-10"><div class="checkbox">
                                <?php echo $form->checkBox($model,'group_event',array('value' => '1', 'uncheckValue'=>'0')); ?>
                                <?php echo $form->error($model,'group_event'); ?>
                        </div></div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'email_confirm',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-10"><div class="checkbox">
                                <?php echo $form->checkBox($model,'email_confirm',array('value' => '1', 'uncheckValue'=>'0')); ?>
                                <?php echo $form->error($model,'email_confirm'); ?>
                        </div></div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'sms_confirm',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-10"><div class="checkbox">
                                <?php echo $form->checkBox($model,'sms_confirm',array('value' => '1', 'uncheckValue'=>'0')); ?>
                                <?php echo $form->error($model,'sms_confirm'); ?>
                        </div></div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'email_reminder',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-10"><div class="checkbox">
                                <?php echo $form->checkBox($model,'email_reminder',array('value' => '1', 'uncheckValue'=>'0')); ?>
                                <?php echo $form->error($model,'email_reminder'); ?>
                        </div></div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'sms_reminder',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-10"><div class="checkbox">
                                <?php echo $form->checkBox($model,'sms_reminder',array('value' => '1', 'uncheckValue'=>'0')); ?>
                                <?php echo $form->error($model,'sms_reminder'); ?>
                        </div></div>
                    </div>

                    <!--div class="form-group">
                        <?php echo $form->labelEx($model,'event_confirm',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-10"><div class="checkbox">
                                <?php echo $form->checkBox($model,'event_confirm',array('value' => '1', 'uncheckValue'=>'0')); ?>
                                <?php echo $form->error($model,'event_confirm'); ?>
                        </div></div>
                    </div-->

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'email_event',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-10"><div class="checkbox">
                                <?php echo $form->checkBox($model,'email_event',array('value' => '1', 'uncheckValue'=>'0')); ?>
                                <?php echo $form->error($model,'email_event'); ?>
                        </div></div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'sms_event',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-10"><div class="checkbox">
                                <?php echo $form->checkBox($model,'sms_event',array('value' => '1', 'uncheckValue'=>'0')); ?>
                                <?php echo $form->error($model,'sms_event'); ?>
                        </div></div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'caldav',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-10"><div class="checkbox">
                                <?php echo $form->checkBox($model,'caldav',array('value' => '1', 'uncheckValue'=>'0')); ?>
                                <?php echo $form->error($model,'caldav'); ?>
                        </div></div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'email_help',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-10"><div class="checkbox">
                                <?php echo $form->checkBox($model,'email_help',array('value' => '1', 'uncheckValue'=>'0')); ?>
                                <?php echo $form->error($model,'email_help'); ?>
                        </div></div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'phone_help',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-10"><div class="checkbox">
                                <?php echo $form->checkBox($model,'phone_help',array('value' => '1', 'uncheckValue'=>'0')); ?>
                                <?php echo $form->error($model,'phone_help'); ?>
                        </div></div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'employee',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-5">
                            <?php echo $form->textField($model,'employee',array('size'=>11,'maxlength'=>11,'class'=>'form-control')); ?>
                            <?php echo $form->error($model,'employee'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'max_employee',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-5">
                            <?php echo $form->textField($model,'max_employee',array('size'=>11,'maxlength'=>11,'class'=>'form-control')); ?>
                            <?php echo $form->error($model,'max_employee'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'event',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-5">
                            <?php echo $form->textField($model,'event',array('size'=>11,'maxlength'=>11,'class'=>'form-control')); ?>
                            <?php echo $form->error($model,'event'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'sms',array('class'=>'col-md-2 control-label') ); ?>
                        <div class="col-md-5">
                            <?php echo $form->textField($model,'sms',array('size'=>11,'maxlength'=>11,'class'=>'form-control')); ?>
                            <?php echo $form->error($model,'sms'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'base_lvl',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-5">
                            <?php echo $form->textField($model,'base_lvl',array('class'=>'form-control')); ?>
                            <?php echo $form->error($model,'base_lvl'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'request_text',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-5">
                            <?php echo $form->textArea($model,'request_text',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
                            <?php echo $form->error($model,'request_text'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'max_sms',array('class'=>'col-md-2 control-label')); ?>
                        <div class="col-md-5">
                            <?php echo $form->textField($model,'max_sms',array('class'=>'form-control')); ?>
                            <?php echo $form->error($model,'max_sms'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


