<div id="register-page">
    <div class="register-wrapper content-wrapper">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'user-form',
            'enableClientValidation'=>false,
            'htmlOptions'=>array(
                'autocomplete'=>'off',
            ),
        )); ?>
        <h2><?= Yii::t('main','Информация о пользователе')?></h2>
        <?php echo $form->emailField($user,'login',array('class'=>'form-input', 'placeholder' =>Yii::t('main','Email').'*')); ?>
        <?php echo Help::error($user,'login'); ?>
        <?php echo $form->passwordField($user,'password',array('class'=>'form-input', 'placeholder' =>Yii::t('main','Пароль').'*')); ?>
        <?php echo Help::error($user,'password'); ?>
        <?php echo $form->passwordField($user,'password_repeat',array('class'=>'form-input', 'placeholder' =>Yii::t('main','Пароль повторно').'*')); ?>
        <?php echo Help::error($user,'password_repeat'); ?>

        <h2><?= Yii::t('main','Информация о компании')?></h2>

        <?php echo $form->textField($company,'name',array('class'=>'form-input', 'placeholder' =>Yii::t('main','Название фирмы').'*')); ?>
        <?php echo Help::error($company,'name'); ?>
        <?php echo $form->textarea($company,'description',array('class'=>'form-input', 'placeholder' =>Yii::t('main','Описание фирмы'), 'style' => 'padding: 10px; height: 100px;')); ?>
        <?php echo Help::error($company,'description'); ?>
        <?php echo CHtml::dropDownList('Company[country_id]',$company->country_id,$country,array('class'=>'form-input', 'placeholder' =>Yii::t('main','Страна'), 'style' => 'width: 350px;')); ?>
        <?php echo $form->textField($company,'city',array('class'=>'form-input', 'placeholder' =>Yii::t('main','Город').'*')); ?>
        <?php echo Help::error($company,'city'); ?>
        <?php echo $form->textField($company,'address',array('class'=>'form-input', 'placeholder' =>Yii::t('main','Адрес').'*')); ?>
        <?php echo Help::error($company,'address'); ?>
        <?php echo $form->numberField($company,'zip',array('class'=>'form-input', 'placeholder' =>Yii::t('main','Индекс').'*')); ?>
        <?php echo Help::error($company,'zip'); ?>
        <?php echo $form->textField($company,'phone',array('class'=>'form-input', 'placeholder' =>Yii::t('main','Телефон'))); ?>
        <?php echo Help::error($company,'phone'); ?>
        <?php echo $form->textField($company,'fax',array('class'=>'form-input', 'placeholder' =>Yii::t('main','Факс'))); ?>
        <?php echo Help::error($company,'fax'); ?>
        <?php echo $form->emailField($company,'email',array('class'=>'form-input', 'placeholder' =>Yii::t('main','E-mail'))); ?>
        <?php echo Help::error($company,'email'); ?>
        <?php echo $form->textField($company,'site',array('class'=>'form-input', 'placeholder' =>Yii::t('main','Адрес сайта'))); ?>
        <?php echo Help::error($company,'site'); ?>
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
                            $("#user-form .errorMessage").hide();
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
    </div>
</div>