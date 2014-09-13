<?php
$this->layout = 'sign';
/**
 * @var $user User
 * @var $company Company
 */
Yii::app()->clientScript->registerCssFile('/css/jquery.fancybox.css');
Yii::app()->clientScript->registerScriptFile('/js/jquery.fancybox.pack.js', CClientScript::POS_END);
?>
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <h1 class="text-center title">Register</h1>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'user-form',
                'enableClientValidation'=>true,
                'htmlOptions'=>array(
                    'autocomplete'=>'off',
                ),
            )); ?>
            User Info
                <div class="form-group">
                    <div class="controls with-icon-over-input">
                        <?php echo $form->emailField($user,'login',array('placeholder' =>'Email*', 'class' => 'form-control')); ?>
                        <?php echo $form->error($user,'login'); ?>
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls with-icon-over-input">
                        <?php echo $form->passwordField($user,'password',array('placeholder' =>'Password*', 'class' => 'form-control')); ?>
                        <?php echo $form->error($user,'password'); ?>
                        <i class="icon-user icon-lock text-muted"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls with-icon-over-input">
                        <?php echo $form->passwordField($user,'password_repeat',array('placeholder' =>'Password repeat*', 'class' => 'form-control')); ?>
                        <?php echo $form->error($user,'password_repeat'); ?>
                        <i class="icon-user icon-lock text-muted"></i>
                    </div>
                </div>

            Company Info


            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->textField($company,'name',array('placeholder' =>'Company Name', 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'name'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->textarea($company,'description',array('placeholder' =>'Company Description', 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'description'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo CHtml::dropDownList('Company[country_id]',$company->country_id,$country,array('placeholder' =>'Country', 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->textField($company,'city',array('placeholder' =>'City', 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'city'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->textField($company,'address',array('placeholder' =>'Address', 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'address'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->numberField($company,'zip',array('placeholder' =>'Zip Code', 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'zip'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->textField($company,'phone',array('placeholder' =>'Phone', 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'phone'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->textField($company,'fax',array('placeholder' =>'Fax', 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'fax'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->emailField($company,'email',array('placeholder' =>'E-mail', 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'email'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->textField($company,'site',array('placeholder' =>'Site', 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'site'); ?>
                </div>
            </div>



                <?=
                 CHtml::ajaxSubmitButton('Register',CHtml::normalizeUrl(array('user/register')),
                    array(
                        'dataType'=>'json',
                        'type'=>'post',
                        'beforeSend'=>'function(){$.fancybox.showLoading();}',
                        'success'=>'function(data)
                        {
                         if(data.status=="success")
                          {
                           location.href=data.url;
                          }
                          else
                          {
                            $.each(data, function(key, val)
                            {
                              $("#user-form #"+key+"_em_").text(val);
                              $("#user-form #"+key+"_em_").show();
                            });
                          }
                          $.fancybox.hideLoading();
                        }'
                    ),array('class' => 'btn btn-block'));

                ?>
            <?php $this->endWidget(); ?>

            <div class="text-center">
                <hr class="hr-normal">
                <!--a href="#">Forgot your password?</a-->
            </div>
        </div>
    </div>
</div>
