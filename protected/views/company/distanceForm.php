<?php
/**
 * @var $this CompanyController
 */
$this->layout = 'companyLayout';
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
        'role'=>"form",
    ),
    'id'=>'validate-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
        'validateOnChange'=>false,
    ),
)); ?>
<div class="box">
    <div class="box-header green-background">
        <div class="title"><div class="icon-info"></div> <?php echo Yii::t('main','Информация для счета')?></div>
    </div>
    <div class="box-content">
        <div class="form-group">
            <?php echo $form->label($model,'name',array('class'=>"col-lg-2 control-label")); ?>
            <div class="col-lg-10">
                <?php echo $form->textField($model,'name',array('class'=>'form-control','placeholder'=>Yii::t('main','Фирма'))) ?>
                <?php echo $form->error($model,'name'); ?>
            </div>
        </div>
        <!--div class="form-group">
            <?php echo $form->label($model,'city',array('class'=>"col-lg-2 control-label")); ?>
            <div class="col-lg-10">
                <?php echo $form->textField($model,'city',array('class'=>'form-control','placeholder'=>Yii::t('main','Город'))) ?>
                <?php echo $form->error($model,'city'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->label($model,'address',array('class'=>"col-lg-2 control-label")); ?>
            <div class="col-lg-10">
                <?php echo $form->textField($model,'address',array('class'=>'form-control','placeholder'=>Yii::t('main','улица, дом'))) ?>
                <?php echo $form->error($model,'address'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->label($model,'zip',array('class'=>"col-lg-2 control-label")); ?>
            <div class="col-lg-10">
                <?php echo $form->textField($model,'zip',array('class'=>'form-control','placeholder'=>Yii::t('main','улица, дом'))) ?>
                <?php echo $form->error($model,'zip'); ?>
            </div>
        </div-->
        <div class="form-group">
            <?php echo $form->label($model,'iban',array('class'=>"col-lg-2 control-label")); ?>
            <div class="col-lg-10">
                <?php echo $form->textField($model,'iban',array('class'=>'form-control','placeholder'=>Yii::t('main','ИБАН'))) ?>
                <?php echo $form->error($model,'iban'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->label($model,'bic',array('class'=>"col-lg-2 control-label")); ?>
            <div class="col-lg-10">
                <?php echo $form->textField($model,'bic',array('class'=>'form-control','placeholder'=>Yii::t('main','БИК'))) ?>
                <?php echo $form->error($model,'bic'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->label($model,'email',array('class'=>"col-lg-2 control-label")); ?>
            <div class="col-lg-10">
                <?php echo $form->textField($model,'email',array('class'=>'form-control','placeholder'=>Yii::t('main','E-mail'))) ?>
                <?php echo $form->error($model,'email'); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10">
                <button type="submit" value="1" name="save" class="btn btn-success"><?=Yii::t('main','Выслать счет')?></button>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>