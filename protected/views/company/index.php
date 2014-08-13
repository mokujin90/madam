<?php
    $this->layout = 'companyLayout';
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
        'role'=>"form"
    ),
)); ?>
    <div class="col-xs-12 col-lg-6">
        <div class="form-group">
            <?php echo $form->label($model,'name',array('class'=>"col-lg-4 control-label")); ?>
            <div class="col-lg-8">
                <?php echo $form->textField($model,'name',array('class'=>'form-control','placeholder'=>Yii::t('main','Фирма'))) ?>
                <?php echo $form->error($model,'name'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->label($model,'description',array('class'=>"col-lg-4 control-label")); ?>
            <div class="col-lg-8">
                <?php echo $form->textField($model,'description',array('class'=>'form-control','placeholder'=>Yii::t('main','О фирме'))) ?>
                <?php echo $form->error($model,'description'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-4 control-label"><?=Yii::t('main','Выбор страны')?></label>
            <div class="col-lg-8">
                <?=CHtml::dropDownList('Company[country_id]',$model->country_id,Help::decorate($country,'name'),array('class'=>"form-control"))?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->label($model,'zip',array('class'=>"col-lg-4 control-label")); ?>
            <div class="col-lg-8">
                <?php echo $form->textField($model,'zip',array('class'=>'form-control','placeholder'=>Yii::t('main','Индекс'))) ?>
                <?php echo $form->error($model,'zip'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->label($model,'city',array('class'=>"col-lg-4 control-label")); ?>
            <div class="col-lg-8">
                <?php echo $form->textField($model,'city',array('class'=>'form-control','placeholder'=>Yii::t('main','Город'))) ?>
                <?php echo $form->error($model,'city'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->label($model,'address',array('class'=>"col-lg-4 control-label")); ?>
            <div class="col-lg-8">
                <?php echo $form->textField($model,'address',array('class'=>'form-control','placeholder'=>Yii::t('main','улица, дом'))) ?>
                <?php echo $form->error($model,'address'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->label($model,'phone',array('class'=>"col-lg-4 control-label")); ?>
            <div class="col-lg-8">
                <?php echo $form->textField($model,'phone',array('class'=>'form-control','pattern'=>"^[0-9]+$",'placeholder'=>Yii::t('main','Номер телефона'))) ?>
                <?php echo $form->error($model,'phone'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->label($model,'mobile_phone',array('class'=>"col-lg-4 control-label")); ?>
            <div class="col-lg-8">
                <?php echo $form->textField($model,'mobile_phone',array('class'=>'form-control','pattern'=>"^[0-9]+$",'placeholder'=>Yii::t('main','Мобильный'))) ?>
                <?php echo $form->error($model,'mobile_phone'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->label($model,'fax',array('class'=>"col-lg-4 control-label")); ?>
            <div class="col-lg-8">
                <?php echo $form->textField($model,'fax',array('class'=>'form-control','pattern'=>"^[0-9]+$",'placeholder'=>Yii::t('main','Факс'))) ?>
                <?php echo $form->error($model,'fax'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->label($model,'email',array('class'=>"col-lg-4 control-label")); ?>
            <div class="col-lg-8">
                <?php echo $form->emailField($model,'email',array('class'=>'form-control','placeholder'=>Yii::t('main','E-mail'))) ?>
                <?php echo $form->error($model,'email'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->label($model,'site',array('class'=>"col-lg-4 control-label")); ?>
            <div class="col-lg-8">
                <?php echo $form->textField($model,'site',array('class'=>'form-control','placeholder'=>'www.exaple.com')) ?>
                <?php echo $form->error($model,'site'); ?>
            </div>
        </div>


        <div class="form-group">
            <hr>
            <div class="col-lg-6">
                <button type="submit" value="1" name="save" class="btn btn-success"><?=Yii::t('main','Сохранить')?></button>
            </div>
        </div>
    </div>
<?php $this->endWidget(); ?>
    <div class="col-xs-12 col-lg-6">
        <h4>Данные компании</h4>
            <span>
                В реестре сведения о компании и выбрать приложение, установить состояние и введите свой ​​адрес и контактную один .. О применении быть предустановлен промышленность особые условия и поля даты. Via выбора государства календаря автоматически заполняется с официальных государственных праздников. адрес и контактная информация отображаются в онлайн-бронирования назначения в адрес поля. наконечником: Если вы перемещаете указатель мыши в знак вопроса, окна объяснение здесь появится на поле справа.
            </span>
    </div>
</form>