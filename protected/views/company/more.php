<?php
/**
 * @var $this CompanyController
 * @var $manual License
 * @var $oldLicense Company2License
 * @var $companyId int
 */
$this->layout = 'companyLayout';
Yii::app()->clientScript->registerScriptFile('/js/main.js');
Yii::app()->clientScript->registerScript('calendarInit', 'more.init()', CClientScript::POS_READY);

?>
<div class="row box box-transparent">
    <div class="col-xs-4 col-sm-2">
        <div class="box-quick-link blue-background">
            <a href="<?=$this->createUrl('company/more',array('type'=>1))?>">
                <div class="header">
                    <div class="icon-comments"></div>
                </div>
                <div class="content">1 <?php echo Yii::t('main','уровень')?></div>
            </a>
        </div>
    </div>
    <div class="col-xs-4 col-sm-2">
        <div class="box-quick-link green-background">
            <a href="<?=$this->createUrl('company/more',array('type'=>2))?>">
                <div class="header">
                    <div class="icon-star"></div>
                </div>
                <div class="content">2 <?php echo Yii::t('main','уровень')?></div>
            </a>
        </div>
    </div>
    <div class="col-xs-4 col-sm-2">
        <div class="box-quick-link orange-background">
            <a href="<?=$this->createUrl('company/more',array('type'=>3))?>">
                <div class="header">
                    <div class="icon-magic"></div>
                </div>
                <div class="content">3 <?php echo Yii::t('main','уровень')?></div>
            </a>
        </div>
    </div>
    <div class="col-xs-4 col-sm-2">
        <div class="box-quick-link purple-background">
            <a href="#" id="manual-edit">
                <div class="header">
                    <div class="icon-eye-open"></div>
                </div>
                <div class="content"><?php echo Yii::t('main','Индивидуально')?></div>
            </a>
        </div>
    </div>
    <?if($oldLicense['license']->getLicenseType()!=0):?>
        <div class="col-xs-4 col-sm-2">
            <div class="box-quick-link red-background">
                <a href="<?=$this->createUrl('company/more',array('type'=>'employee'))?>">
                    <div class="header">
                        <div class="icon-inbox"></div>
                    </div>
                    <div class="content">+1 <?php echo Yii::t('main','Работник')?></div>
                </a>
            </div>
        </div>
        <div class="col-xs-4 col-sm-2">
            <div class="box-quick-link muted-background">
                <a href="<?=$this->createUrl('company/more',array('type'=>'sms'))?>">
                    <div class="header">
                        <div class="icon-refresh"></div>
                    </div>
                    <div class="content">+100 sms</div>
                </a>
            </div>
        </div>
    <?endif;?>
</div>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'license-form',
    'enableAjaxValidation'=>false,
    'action'=>'?type=manual',
    'htmlOptions'=>array(
        'class'=>'form form-horizontal',
        'style'=>"display:none;"
    )
)); ?>
    <?php $this->renderPartial('/admin/_license', array('model'=>$manual,'form'=>$form)); ?>
    <div class="col-lg-6">
        <button type="submit" value="1" name="save" class="btn btn-success"><?=$model->isNewRecord ? 'Create' : 'Save'?></button>
    </div>
<?php $this->endWidget(); ?>