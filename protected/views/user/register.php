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
            <h1 class="text-center title"><?= Yii::t('main','Регистрация')?></h1>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'user-form',
                'enableClientValidation'=>true,
                'htmlOptions'=>array(
                    'autocomplete'=>'off',
                ),
            )); ?>
                <?= Yii::t('main','Информация о пользователе')?>
                <div class="form-group">
                    <div class="controls with-icon-over-input">
                        <?php echo $form->emailField($user,'login',array('placeholder' =>Yii::t('main','Email').'*', 'class' => 'form-control')); ?>
                        <?php echo $form->error($user,'login'); ?>
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls with-icon-over-input">
                        <?php echo $form->passwordField($user,'password',array('placeholder' =>Yii::t('main','Пароль').'*', 'class' => 'form-control')); ?>
                        <?php echo $form->error($user,'password'); ?>
                        <i class="icon-user icon-lock text-muted"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls with-icon-over-input">
                        <?php echo $form->passwordField($user,'password_repeat',array('placeholder' =>Yii::t('main','Пароль повторно').'*', 'class' => 'form-control')); ?>
                        <?php echo $form->error($user,'password_repeat'); ?>
                        <i class="icon-user icon-lock text-muted"></i>
                    </div>
                </div>

            <?= Yii::t('main','Информация о компании')?>


            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->textField($company,'name',array('placeholder' =>Yii::t('main','Название фирмы').'*', 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'name'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->textarea($company,'description',array('placeholder' =>Yii::t('main','Описание фирмы'), 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'description'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo CHtml::dropDownList('Company[country_id]',$company->country_id,$country,array('placeholder' =>Yii::t('main','Страна'), 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->textField($company,'city',array('placeholder' =>Yii::t('main','Город').'*', 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'city'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->textField($company,'address',array('placeholder' =>Yii::t('main','Адрес').'*', 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'address'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->numberField($company,'zip',array('placeholder' =>Yii::t('main','Индекс').'*', 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'zip'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->textField($company,'phone',array('placeholder' =>Yii::t('main','Телефон'), 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'phone'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->textField($company,'fax',array('placeholder' =>Yii::t('main','Факс'), 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'fax'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->emailField($company,'email',array('placeholder' =>Yii::t('main','E-mail'), 'class' => 'form-control')); ?>
                    <?php echo $form->error($company,'email'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="controls with-icon-over-input">
                    <?php echo $form->textField($company,'site',array('placeholder' =>Yii::t('main','Адрес сайта'), 'class' => 'form-control')); ?>
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
