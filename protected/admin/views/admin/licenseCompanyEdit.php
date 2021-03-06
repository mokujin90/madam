<?
/**
 * @var $this AdminCompanyController
 * @var $current Company2License
 * @var $model License
 * @var $company Company
 * @var $current['license'] License
 */
Yii::app()->clientScript->registerScript('license', 'license.init()', CClientScript::POS_READY);
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'license-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'class'=>'form form-horizontal'
    )
)); ?>
<div class="col-sm-12">
    <div class="form-group">
    <?php echo CHtml::dropDownList('license_type',$current['license']->getLicenseType(),array(License::$base[1]=>Yii::t('main','1 уровень'),
    License::$base[2]=>Yii::t('main','2 уровень'),License::$base[3]=>Yii::t('main','3 уровень'),
    License::$base[0]=>Yii::t('main','Индивидуальный набор')),
    array('class' => 'form-control'))?>
    </div>
</div>

    <?php $this->renderPartial('/admin/_license', array('model'=>$model,'form'=>$form,'style' => $current['license']->getLicenseType()==0 ? '' : 'display:none;')); ?>




    <div class="form-group" id="update-license" style="<?=$current['license']->getLicenseType()==0 ? "display:none;":''?>">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header blue-background">
                    <div class="title"><div class="icon-edit"></div><?php echo Yii::t('main','Улучшение лицензии')?></div>
                </div>
                <div class="box-content">
                    <div class="form-group">
                    <?php echo CHtml::label(Yii::t('main','Увеличить количество работников:'),'',array('class'=>'col-md-2 control-label'))?>
                        <div class="col-md-5">
                            <?php echo CHtml::numberField('added[employee]',$current->employee_upgrade,array('class'=>'form-control'))?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo CHtml::label(Yii::t('main','Увеличить количество sms:'),'',array('class'=>'col-md-2 control-label'))?>
                        <div class="col-md-5">
                            <?php echo CHtml::numberField('added[sms]',$current->sms_upgrade,array('class'=>'form-control'))?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?if($model->getLicenseType()==0):?>
    <?php $this->renderPartial('/admin/_price', array('model'=>$model,'form'=>$form)); ?>
<?endif;?>
    <div class="box">
        <div class="box-header green-background">
            <div class="title"><div class="icon-dollar"></div> <?php echo Yii::t('main','Бессрочность лицензий для этой компании')?></div>
        </div>
        <div class="box-content">
            <div class="form-group">
                <?php echo $form->labelEx($company,'no_expiration',array('class'=>'col-md-2 control-label')); ?>
                <div class="col-md-5">
                    <?php echo $form->checkbox($company,'no_expiration',array('value'=>1, 'uncheckValue'=>0)); ?>
                    <?php echo $form->error($company,'no_expiration'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <button type="submit" value="1" name="save" class="btn btn-success"><?= Yii::t('main',$model->isNewRecord ? 'Создать' : 'Сохранить')?></button>
    </div>
<?php $this->endWidget(); ?>