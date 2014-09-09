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

    <div class="box col-xs-12 col-sm-6">
        <div class="box-header green-background">
            <div class="title"><i class="icon-calendar"></i> <?= Yii::t('main','Дата')?></div>
        </div>
        <div class="box-content">
            <div class="form-group">
                <div class="controls"><?=$date?> (<?=$delay?> min)</div>
            </div>
        </div>
    </div>

    <div style="clear:both;" class="box col-xs-12 col-sm-6">
        <div class="box-header blue-background">
            <div class="title"><i class="icon-user"></i> <?= Yii::t('main','Работник')?></div>
        </div>
        <div class="box-content">
            <div class="form-group">
                <?=$user->getName()?>
            </div>
        </div>
    </div>

    <div style="clear:both;" class="box col-xs-12 col-sm-6">
        <div class="box-header green-background">
            <div class="title"><i class="icon-building"></i> <?= Yii::t('main','Компания')?></div>
        </div>
        <div class="box-content">
            <div class="form-group">
                <?=$company->name?>
            </div>
            <div class="form-group">
                <?=$company['country']->name?> <?=$company->address?>, <?=$company->city?>
            </div>
            <div class="form-group">
                <?php echo CHtml::mailto($company->email,$company->email)?>
            </div>
        </div>
    </div>

    <div style="clear:both;" class="box col-xs-12 col-sm-6">
        <div class="box-header blue-background">
            <div class="title"><i class="icon-gears"></i> <?= Yii::t('main','Детальная информация')?></div>
        </div>
        <div class="box-content">
            <?foreach($fields as $item):?>
                <div class="row">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 control-label"><?=$item->name?></label>
                        <div class="col-xs-10 col-sm-6"><?=$fieldText[$item->id]?></div>
                    </div>
                </div>
            <?endforeach;?>

        </div>
    </div>
<div style="clear:both;" class="box col-xs-12 col-sm-6">
    <div class="box-header green-background">
        <div class="title"><i class="icon-question-sign"></i> <?= Yii::t('main','Вопросы')?></div>
    </div>
    <div class="box-content">
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

    </div>
</div>

