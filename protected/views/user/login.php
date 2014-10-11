<?php
/* @var $this SiteController */
$this->layout = 'sign';
?>

                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-4">
                            <h1 class="text-center title"><?= Yii::t('main','Авторизация')?></h1>


                            <?php
                            $model = new LoginForm;
                            $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'login-form',
                            'action' => '/user/login',
                            'htmlOptions'=>array(
                                'class'=>'validate-form',
                            ),
                            )); ?>
                            <div class="form-group">
                                <div class="controls with-icon-over-input">
                                    <?php echo $form->textField($model,'username',array('placeholder' =>Yii::t('main','E-mail'), 'class' => 'form-control')); ?>
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="controls with-icon-over-input">
                                    <?php echo $form->passwordField($model,'password',array('placeholder' =>Yii::t('main','Пароль'), 'class' => 'form-control')); ?>
                                    <i class="icon-lock text-muted"></i>
                                </div>
                            </div>

                            <div class="checkbox">
                                <label for="LoginForm_rememberMe">
                                    <?php echo $form->checkBox($model,'rememberMe'); ?>
                                    <?= Yii::t('main','Запомнить меня')?>
                                </label>
                            </div>

                            <?php echo CHtml::submitButton(Yii::t('main','Войти'), array('class' => 'btn btn-block')); ?>

                            <?php $this->endWidget(); ?>

                            <div class="text-center">
                                <hr class="hr-normal">
                                <!--a href="#">Forgot your password?</a-->
                            </div>
                        </div>
                    </div>
                </div>
