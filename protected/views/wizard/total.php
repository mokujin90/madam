<?php
/**
 * @var $this WizardController
 * @var $company Company
 * @var $questions Question[]
 * @var $answers array
 * @var $fieldText array
 * @var $fields CompanyField[]
 * @var $info Distance
 * @var $request Request
 *
 */
?>
<script>
    $(".fancy").fancybox({});
</script>
<?if(!is_null($info) && $info->isRequired()):?>
    <div class="alert alert-info alert-dismissable">
        <a class="close" data-dismiss="alert" href="#">×
        </a>

        <h4>
            <i class="icon-info-sign"></i>
            <?= Yii::t('main','Информация')?>
        </h4>
        <?= Yii::t('main','Подтвердите, что ознакомились с юридической информацией, и нажмите "Финиш"')?>
    </div>

<?endif;?>
<div class="row">
    <div class="form-group">
        <label class="col-xs-12 col-sm-4 control-label"><?= Yii::t('main','Дата')?>:</label>
        <div class="col-xs-10 col-sm-6"><?=$date?> (<?=$delay?> min)</div>
    </div>
</div>
<?if(!is_null($user)):?>
    <div class="row">
        <div class="form-group">
            <label class="col-xs-12 col-sm-4 control-label"><?= Yii::t('main','Работник')?>:</label>
            <div class="col-xs-10 col-sm-6">
                <?=$user->getName()?>
            </div>
        </div>
    </div>
<?endif;?>
<div class="row">
    <div class="form-group">
        <label class="col-xs-12 col-sm-4 control-label"><?= Yii::t('main','Компания')?>:</label>
        <div class="col-xs-10 col-sm-6"><?=$company->name?></div>
    </div>
</div>
<div class="row">
    <div class="form-group">
        <label class="col-xs-12 col-sm-4 control-label"></label>
        <div class="col-xs-10 col-sm-6"><?=$company['country']->name?> <?=$company->address?>, <?=$company->city?></div>
    </div>
</div>
<div class="row">
    <div class="form-group">
        <label class="col-xs-12 col-sm-4 control-label"></label>
        <div class="col-xs-10 col-sm-6"><?php echo CHtml::mailto($company->email,$company->email)?></div>
    </div>
</div>
<?if($info->show_term==1):?>
    <div class="row">
        <div class="form-group">
            <label class="col-xs-12 col-sm-4 control-label"></label>
            <div class="col-xs-10 col-sm-6"><?=$info->getTermLink('Terms and conditions');?></div>
        </div>
    </div>
<?endif;?>
<hr>
<h4 class="col-xs-12 row"><?= Yii::t('main','Детальная информация')?></h4>
<?foreach($fields as $item):?>
    <div class="row">
        <div class="form-group">
            <label class="col-xs-12 col-sm-4 control-label"><?=$item->name?></label>
            <div class="col-xs-10 col-sm-6"><?=$fieldText[$item->id]?></div>
        </div>
    </div>
<?endforeach;?>
<hr>
<h4 class="col-xs-12 row"><?= Yii::t('main','Вопросы')?></h4>
<?foreach($questions as $item):?>
    <div class="row">
        <div class="form-group">
            <label class="col-xs-12 col-sm-4 control-label"><?=$item->text?>:</label>
            <div class="col-xs-10 col-sm-6">
                <?foreach($answers as $inner):?>
                    <?if($inner->question_id==$item->id):?>
                        <?=$inner->text?>,
                    <?endif;?>
                <?endforeach;?>
            </div>
        </div>
    </div>
<?endforeach;?>
<hr>
<div class="col-xs-12 row">
    <?if($info->show_privacy==1):?>
        <?$link = CHtml::link(Yii::t('main','Политика конфиденциальности'),'#privacy-block',array('class'=>'fancy'))?>
        <?if($info->request_privacy==0):?>
            <?= Yii::t('main','мной прочтена')?><?=$link?>
        <?else:?>
            <?php echo CHtml::checkBox('',false,array('class'=>"required"))?>
            <?=$link?> <?= Yii::t('main','мной прочтена и принята')?>
        <?endif;?>
    <?endif;?>
</div>

<div class="col-xs-12 row">
    <?if($info->show_condition==1):?>
        <?=$info->note_condition." ".CHtml::link(Yii::t('main','Подробная информация'),'#condition-block',array('class'=>'fancy'))?>
    <?endif;?>
</div>

<div class="col-xs-12 row">
    <?if($info->show_reference==1):?>
        <?=$info->text_reference?>
    <?endif;?>
</div>

<div class="col-xs-12 row">
    <?if($info->show_reference_add==1):?>
        <?if($info->request_reference_add==1):?>
            <?php echo CHtml::checkBox('',false,array('class'=>"required",'id'=>'check_01'))?>
            <?php echo CHtml::label($info->text_reference_add,'check_01')?>
        <?else:?>
            <?=$info->text_reference_add?>
        <?endif;?>
    <?endif;?>
</div>

<div class="col-xs-12 row">
    <?if($info->show_term==1):?>
        <?if($info->request_term==1):?>
            <?php echo CHtml::checkBox('',false,array('class'=>"required"))?>
            <?= Yii::t('main','Я прочел и принял эти')?> <?=$info->getTermLink(Yii::t('main','условия'))?>
        <?else:?>
            <?= Yii::t('main','Я прочел и принял эти')?> <?=$info->getTermLink(Yii::t('main','условия'))?>
        <?endif;?>
    <?endif;?>
</div>
<hr>
<div class="row">
    <div class="form-group">
        <label class="col-xs-12 col-sm-4 control-label wizard-notice-label"><?= Yii::t('main','Email напоминание')?></label>
        <div class="col-xs-10 col-sm-3">
            <?php echo CHtml::dropDownList('Request[alarm_time]',$request->alarm_time,array('-1'=>Yii::t('main','не получать'),1=>Yii::t('main',"за {n} час",array('{n}'=>1)),2=>Yii::t('main',"за {n} часа",array('{n}'=>2)), 3=>Yii::t('main',"за {n} часа",array('{n}'=>3)), 4=>Yii::t('main',"за {n} часа",array('{n}'=>4))),array('class'=>'form-control'))?>
        </div>
    </div>
</div>
