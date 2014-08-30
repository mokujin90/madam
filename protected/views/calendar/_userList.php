<?$select = true;
foreach($user as $item):?>
<div class="box-content box-statistic">
    <h3 class="title text-error"><label class="margin-0"><?=CHtml::radioButton('employee_id', $select, array('class' => 'employee-selection', 'id' => false))?> <?=$item->lastname?>&nbsp<?=$item->name?></label></h3>
    <div class="text-error icon-user align-right"></div>
</div>
<?$select = false;?>
<?endforeach?>