<?php
/**
 * @var $this CompanyController
 * @var $manual License
 * @var $oldLicense Company2License
 * @var $companyId int
 * @var $standard License[]
 */
$this->layout = 'companyLayout';
Yii::app()->clientScript->registerScriptFile('/js/main.js');
Yii::app()->clientScript->registerScript('calendarInit', 'more.init()', CClientScript::POS_READY);
$data = array(
    License::$base[1]=>array('count_star'=>1,'header_class'=>'blue-background'),
    License::$base[2]=>array('count_star'=>2,'header_class'=>'purple-background'),
    License::$base[3]=>array('count_star'=>3,'header_class'=>'red-background'),
);
$check=array('control_dialog','group_event','email_confirm','sms_confirm','email_reminder','sms_reminder','multilanguage','event_confirm','email_event','sms_event','caldav','email_help','phone_help');
?>
<?Yii::app()->clientScript->registerCssFile('/css/pricetab.css');?>
<?if(Yii::app()->user->hasFlash('alert')):?>
<div class="col-xs-12">
    <div class="alert alert-warning alert-dismissable">
        <i class="icon-warning-sign"></i> <?=Yii::app()->user->getFlash('alert')?>
    </div>
</div>
<?endif?>
<div class="col-xs-12">
    <div class="alert alert-info alert-dismissable">
        <i class="icon-info-sign"></i> <?=$licenseAlert?>
    </div>
</div>

<div class="main-box-body clearfix">
<?$count=1?>
<?foreach($standard as $license):?>
    <div class="col-md-3 col-sm-6 col-xs-12 pricing-package">
        <div class="pricing-package-inner">
            <div class="package-header <?=$data[$license->id]['header_class']?>">
                <div class="stars text-center">
                    <?php
                    $countStar = $data[$license->id]['count_star'];
                        for ($x=0; $x<$countStar; $x++) echo '<i class="icon-star"></i>';
                    ?>
                </div>
                <h3></i><?= Yii::t('main',$license->request_text)?></h3>
            </div>
            <div class="package-content">
                <div class="package-price"><?=$license->price==0 ? 'FREE' : "$".$license->price.'<span class="package-month">/mo</span>'?></span>
                </div>
                <ul class="package-top-features">
                    <li>
                        <?=$license->question?> <?=License::model()->getAttributeLabel('question')?>
                    </li>
                    <li>
                        <?=$license->employee?> <?=License::model()->getAttributeLabel('employee')?>
                    </li>
                    <li>
                        <?=$license->event?> <?=License::model()->getAttributeLabel('event')?>
                    </li>
                    <li>
                        <?=$license->sms?> <?=License::model()->getAttributeLabel('sms')?>
                    </li>
                    <li>
                        <?=$license->max_sms?> <?=License::model()->getAttributeLabel('max_sms')?>
                    </li>
                </ul>
                <ul class="package-features">
                    <?foreach($check as $field):?>
                        <li class="<?=$license->getClass($field)?>">
                            <?=License::model()->getAttributeLabel($field)?>
                        </li>
                    <?endforeach;?>
                </ul>
                <?if($license->id==$oldLicense->license_id && $oldLicense['license']->getLicenseType()!=0):?>
                    <a class="buy-action btn disabled" href="#"><i class="icon-ok"></i> <?= Yii::t('main','Действует')?></a>
                <?elseif($license->id<$oldLicense->license_id && $oldLicense['license']->getLicenseType()!=0):?>
                    <a class="buy-action btn btn-inverse disabled" href="#"><i class="icon-lock"></i> <?= Yii::t('main','Выбрать')?></a>
                <?else:?>
                    <a class="buy-action btn btn-inverse" href="<?=$this->createUrl('company/more',array('type'=>$count))?>"><i class="icon-money"></i> <?= Yii::t('main','Выбрать')?></a>
                <?endif;?>
            </div>
        </div>
    </div>
    <?$count++;?>
<?endforeach?>

<div class="col-md-3 col-sm-6 col-xs-12 pricing-package">

    <div class="pricing-package-inner">
        <div class="package-header orange-background">
            <div class="stars text-center">
                <i class="icon-star"></i>
                <i class="icon-star"></i>
                <i class="icon-star"></i>
                <i class="icon-star"></i>
            </div>
            <h3><?=Yii::t('main','Индивидуальная')?></h3>
        </div>
        <div class="package-content">
            <div class="package-price">FREE</span>
            </div>
            <ul class="package-top-features">
                <li>
                    <?=Yii::t('main','Ручная настройка')?>
                </li>
            </ul>
            <?if($oldLicense['license']->getLicenseType()==0):?>
                <a class="buy-action btn disabled" href="#"><i class="icon-ok"></i> <?= Yii::t('main','Действует')?></a>
            <?else:?>
                <a id="manual-edit" class="buy-action btn btn-inverse" href="#"><i class="icon-money"></i> <?= Yii::t('main','Выбрать')?></a>
            <?endif;?>

        </div>
    </div>
    <?if($oldLicense['license']->getLicenseType()!=0):?>
        <?$enableEmployee = ($oldLicense->employee_upgrade+$oldLicense['license']->employee+1 <= $oldLicense['license']->max_employee )?>
        <div class="pricing-package-inner">
            <div class="package-header <?=$enableEmployee ? 'orange-background': 'muted-background'?>">
                <div class="stars text-center">
                    <i class="icon-user"></i>
                </div>
                <h3>Работник</h3>
            </div>
            <div class="package-content">
                <div class="package-price">FREE</span>
                </div>
                <ul class="package-top-features">
                    <li>
                        + 1 <?= Yii::t('main','работник(график)')?>
                    </li>
                </ul>
                <?if($enableEmployee):?>
                    <a id="manual-edit" class="buy-action btn btn-inverse" href="<?=$this->createUrl('company/more',array('type'=>'employee'))?>"><i class="icon-money"></i> <?= Yii::t('main','Выбрать')?></a>
                <?else:?>
                    <a class="buy-action btn btn-inverse disabled" href="#"><i class="icon-lock"></i> <?= Yii::t('main','Не доступно')?></a>
                <?endif;?>

            </div>
        </div>
    <?$enableSms = ($oldLicense->sms_upgrade+$oldLicense['license']->sms+100 <= $oldLicense['license']->max_sms )?>
    <div class="pricing-package-inner">
            <div class="package-header <?=$enableSms ? 'orange-background': 'muted-background'?>">
                <div class="stars text-center">
                    <i class="icon-envelope"></i>
                </div>
                <h3>Пакет SMS</h3>
            </div>
            <div class="package-content">
                <div class="package-price">FREE</span>
                </div>
                <ul class="package-top-features">
                    <li>
                        + 100 SMS
                    </li>
                </ul>
                <?if($enableSms):?>
                    <a id="manual-edit" class="buy-action btn btn-inverse" href="<?=$this->createUrl('company/more',array('type'=>'sms'))?>"><i class="icon-money"></i> <?= Yii::t('main','Выбрать')?></a>
                <?else:?>
                    <a class="buy-action btn btn-inverse disabled" href="#"><i class="icon-lock"></i> <?= Yii::t('main','Не доступно')?></a>
                <?endif;?>

            </div>
        </div>
    <?endif;?>
</div>
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
<?php $this->renderPartial('../../admin/views/admin/_license', array('model'=>$manual,'form'=>$form, 'style' => '')); ?>
<div class="col-lg-6">
    <button type="submit" value="1" name="save" class="btn btn-success"><?= Yii::t('main','Сохранить')?></button>
</div>
<?php $this->endWidget(); ?>

<?if($lastLicense['license']->price>0)://если не подтверждено?>
    <h1>
        <i class="icon-cog"></i>
        <span><?php echo Yii::t('main','Оплата')?></span>
    </h1>
    <?if($oldLicense['license']->id != $lastLicense['license']->id)://отличие?>
    <div class="col-xs-12">
        <div class="alert alert-warning alert-dismissable">
            <i class="icon-warning-sign"></i> <?=Yii::t('main', 'Вы запросили смену лицензии. Для смены произведите оплату.')?>
        </div>
    </div>
    <?endif;?>
    <?=CHtml::link('',array('acquiring/paypal','companyId'=>$companyId,'licenseId'=>$lastLicense->id),array('class'=>"buy-button",'id'=>'paypal'))?>
    <?=CHtml::link('',array('acquiring/sofort','companyId'=>$companyId,'licenseId'=>$lastLicense->id),array('class'=>"buy-button",'id'=>'sofort'))?>
    <?=CHtml::link('<i class="icon-envelope"></i> ' . Yii::t('main','отправить счет на email'),array('acquiring/salesking','companyId'=>$companyId,'licenseId'=>$lastLicense->id),array('class'=>"buy-button",'id'=>'salesking'))?>

<?else:?>
<div class="col-xs-12">
    <div class="alert alert-warning alert-dismissable">
        <i class="icon-warning-sign"></i> <?=Yii::t('main', 'Оплата будет доступна, после установки цены Администратором.')?>
    </div>
</div>
<?endif;?>