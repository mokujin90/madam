<?php
/**
 * @var $this WizardController
 * @var $company Company
 * @var $questions Question[]
 * @var $answers array
 * @var $fieldText array
 * @var $fields CompanyField[]
 * @var $info Distance
 *
 */
?>
<script>
    $(".fancy").fancybox({});
</script>
<?if($info->isRequired()):?>
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
<div class="col-xs-12 col-lg-9">
    <div class="form-group">
        <label class="col-xs-12 col-sm-4 control-label">Date:</label>
        <div class="col-xs-10 col-sm-6"><?=$date?> (<?=$delay?> min)</div>
    </div>
</div>

<div class="col-xs-12 col-lg-9">
    <div class="form-group">
        <label class="col-xs-12 col-sm-4 control-label">Employee:</label>
        <div class="col-xs-10 col-sm-6"><?=$user->getName()?></div>
    </div>
</div>

<div class="col-xs-12 col-lg-9">
    <div class="form-group">
        <label class="col-xs-12 col-sm-4 control-label">With:</label>
        <div class="col-xs-10 col-sm-6"><?=$company->name?></div>
    </div>
</div>
<div class="col-xs-12 col-lg-9">
    <div class="form-group">
        <label class="col-xs-12 col-sm-4 control-label"></label>
        <div class="col-xs-10 col-sm-6"><?=$company['country']->name?> <?=$company->address?>, <?=$company->city?></div>
    </div>
</div>
<div class="col-xs-12 col-lg-9">
    <div class="form-group">
        <label class="col-xs-12 col-sm-4 control-label"></label>
        <div class="col-xs-10 col-sm-6"><?php echo CHtml::mailto($company->email,$company->email)?></div>
    </div>
</div>
<?if($info->show_term==1):?>
    <div class="col-xs-12 col-lg-9">
        <div class="form-group">
            <label class="col-xs-12 col-sm-4 control-label"></label>
            <div class="col-xs-10 col-sm-6"><?=$info->getTermLink('Terms and conditions');?></div>
        </div>
    </div>
<?endif;?>
<div class="col-xs-10 col-sm-9">Детальная информаия</div>
<?foreach($fields as $item):?>
    <div class="col-xs-12 col-lg-9">
        <div class="form-group">
            <label class="col-xs-12 col-sm-4 control-label"><?=$item->name?></label>
            <div class="col-xs-10 col-sm-6"><?=$fieldText[$item->id]?></div>
        </div>
    </div>
<?endforeach;?>

<div class="col-xs-10 col-sm-9">Вопросы</div>
<?foreach($questions as $item):?>
    <div class="col-xs-12 col-lg-9">
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

<div class="col-xs-10 col-sm-9">
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

<div class="col-xs-10 col-sm-9">
    <?if($info->show_condition==1):?>
        <?=$info->note_condition." ".CHtml::link('to the details of the right of withdrawal','#condition-block',array('class'=>'fancy'))?>
    <?endif;?>
</div>

<div class="col-xs-10 col-sm-9">
    <?if($info->show_reference==1):?>
        <?=$info->text_reference?>
    <?endif;?>
</div>

<div class="col-xs-10 col-sm-9">
    <?if($info->show_reference_add==1):?>
        <?if($info->request_reference_add==1):?>
            <?php echo CHtml::checkBox('',false,array('class'=>"required",'id'=>'check_01'))?>
            <?php echo CHtml::label($info->text_reference_add,'check_01')?>
        <?else:?>
            <?=$info->text_reference_add?>
        <?endif;?>
    <?endif;?>
</div>

<div class="col-xs-10 col-sm-9">
    <?if($info->show_term==1):?>
        <?if($info->request_term==1):?>
            <?php echo CHtml::checkBox('',false,array('class'=>"required"))?>
            I have the present <?=$info->getTermLink('Term and Conditions')?>  read and accepted. *
        <?else:?>
            With the appointment booking I agree to the <?=$info->getTermLink('Term')?> disagree.
        <?endif;?>
    <?endif;?>
</div>


