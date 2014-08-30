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
//Help::dump(array($company,$questions,$answers,$fieldText,$fields,$info));
?>

Date:
    <?=$date?>

<br/>
with:
<?=$company->name?>
<?=$company->description?>
<?=$company['country']->name?> <?=$company->address?>, <?=$company->city?>
<?=$company->email?>
<?=$company->url?>

<br/>
Your details:
<?foreach($fields as $item):?>
    <?=$item->name?>: <?=$fieldText[$item->id]?>
<?endforeach;?>

<br/>
<?foreach($questions as $item):?>
    <?=$item->text?>:
    <?foreach($answers as $inner):?>

        <?if($inner->question_id==$item->id):?>
            <?=$inner->text?>,
        <?endif;?>
    <?endforeach;?>
    <?=$fieldText[$item->id]?>
<?endforeach;?>

</br>
<?if($info->show_privacy==1):?>
    <?$link = CHtml::link('Privacy Policy','#privacy-block',array('id'=>'fancy-privacy'))?>
    <?if($info->request_privacy==0):?>
        Here you can find our <?=$link?>
    <?else:?>
        <?php echo CHtml::checkBox('',false,array('class'=>"required"))?>
        <?=$link?> read and accepted *
    <?endif;?>
<?endif;?>

<?if($info->show_condition==1):?>
    <?=$info->note_condition." ".CHtml::link('to the details of the right of withdrawal','#condition-block',array('id'=>'fancy-condition'))?>
<?endif;?>