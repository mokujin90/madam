<div class="content-wrapper">
    <h2><?= Yii::t('main','Авторизация')?></h2>


    <?php
    $model = new LoginForm;
    $form=$this->beginWidget('CActiveForm', array(
    'id'=>'login-form',
    'action' => '/user/login',
    'htmlOptions'=>array(
        'class'=>'validate-form',
    ),
    )); ?>
    <?php echo $form->textField($model,'username',array('class'=>'form-input', 'placeholder' =>Yii::t('main','E-mail'))); ?>
    <?php echo $form->passwordField($model,'password',array('class'=>'form-input', 'placeholder' =>Yii::t('main','Пароль'))); ?>
    <div class="checkbox">
        <label for="LoginForm_rememberMe">
            <?php echo $form->checkBox($model,'rememberMe'); ?>
            <?= Yii::t('main','Запомнить меня')?>
        </label>
    </div>

    <?php echo CHtml::submitButton(Yii::t('main','Войти'), array('class' => 'btn btn-block')); ?>

    <?php $this->endWidget(); ?>
</div>
