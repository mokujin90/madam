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
            Info
        </h4>
        Please check your details and then click 'Finish'.
    </div>

<?endif;?>
<div class="row">
    <div class="form-group">
        <label class="col-xs-12 col-sm-4 control-label">Date:</label>
        <div class="col-xs-10 col-sm-6"><?=$date?> (<?=$delay?> min)</div>
    </div>
</div>
<?if(!is_null($user)):?>
    <div class="row">
        <div class="form-group">
            <label class="col-xs-12 col-sm-4 control-label">Employee:</label>
            <div class="col-xs-10 col-sm-6">
                <?=$user->getName()?>
            </div>
        </div>
    </div>
<?endif;?>
<div class="row">
    <div class="form-group">
        <label class="col-xs-12 col-sm-4 control-label">With:</label>
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
<h4 class="col-xs-12 row">Детальная информация</h4>
<?foreach($fields as $item):?>
    <div class="row">
        <div class="form-group">
            <label class="col-xs-12 col-sm-4 control-label"><?=$item->name?></label>
            <div class="col-xs-10 col-sm-6"><?=$fieldText[$item->id]?></div>
        </div>
    </div>
<?endforeach;?>
<hr>
<h4 class="col-xs-12 row">Вопросы</h4>
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
        <?$link = CHtml::link('Privacy Policy','#privacy-block',array('class'=>'fancy'))?>
        <?if($info->request_privacy==0):?>
            Here you can find our <?=$link?>
        <?else:?>
            <?php echo CHtml::checkBox('',false,array('class'=>"required"))?>
            <?=$link?> read and accepted *
        <?endif;?>
    <?endif;?>
</div>

<div class="col-xs-12 row">
    <?if($info->show_condition==1):?>
        <?=$info->note_condition." ".CHtml::link('to the details of the right of withdrawal','#condition-block',array('class'=>'fancy'))?>
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
            I have the present <?=$info->getTermLink('Term and Conditions')?>  read and accepted. *
        <?else:?>
            With the appointment booking I agree to the <?=$info->getTermLink('Term')?> disagree.
        <?endif;?>
    <?endif;?>
</div>
<hr>
<div class="row">
    <div class="form-group">
        <label class="col-xs-12 col-sm-4 control-label wizard-notice-label">Email напоминание</label>
        <div class="col-xs-10 col-sm-3">
            <?php echo CHtml::dropDownList('Request[alarm_time]',$request->alarm_time,array('-1'=>'не получать',1=>"за 1 час",2=>'за 2 часа', 3=>'за 3 часа', 4=>'за 4 часа'),array('class'=>'form-control'))?>
        </div>
    </div>
</div>
