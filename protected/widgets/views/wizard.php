<?
/**
 * @var $this WizardWidget
 * @var $field CompanyField[]
 */
?>
<div class="dialog">
    <div class="box-content box-padding">
        <div class="fuelux">
            <div class="wizard">
                <ul class="steps">
                    <li class="active" data-target="#step1">
                        <span class="step">1</span>
                    </li>
                    <li data-target="#step2">
                        <span class="step">2</span>
                    </li>
                </ul>
                <div class="actions">
                    <button class="btn btn-xs btn-prev"><i class="icon-arrow-left"></i>Prev
                    </button>
                    <button class="btn btn-xs btn-success btn-next" data-last="Finish">
                        Next
                        <i class="icon-arrow-right"></i>
                    </button>
                </div>
            </div>
            <div class="step-content">
                <hr class="hr-normal">
                <form class="form" style="margin-bottom: 0;" method="post">
                    <input name="authenticity_token" type="hidden">
                    <?php echo CHtml::hiddenField('companyId',$companyId)?>
                    <?php echo CHtml::hiddenField('jsonResult','',array('id'=>'jsonResult'))?>
                    <div class="step-pane active" id="step1" data-type="question">
                        <div class="form-group">
                            <?$numItems = count($question);
                            $i = 0;?>
                            <?foreach($question as $item):?>
                                <div class="question">
                                    <div class="col-xs-12">
                                        <label class="control-label"><?=$item->text?></label>
                                    </div>
                                    <div class="col-xs-11 col-xs-offset-1">
                                        <?=$item->hint?>
                                    </div>
                                    <div class="col-xs-11 col-xs-offset-1">
                                        <div class="form-group">
                                            <?=$this->drawAnswer($item)?>
                                        </div>
                                    </div>
                                </div>
                                <?if(++$i !== $numItems):?>
                                    <hr class="hr-normal">
                                <?endif;?>
                            <?endforeach?>

                        </div>
                    </div>

                    <div class="step-pane" id="step2" data-type="fields">
                        <div class="form-group">
                            <div class="controls">
                                <?$numItems = count($field);
                                $i = 0;?>
                                <?foreach($field as $item):?>
                                    <?=$this->drawField($item)?>
                                <?if(++$i !== $numItems):?>
                                    <hr class="hr-normal">
                                <?endif;?>
                                <?endforeach?>
                            </div>
                        </div>
                    </div>

                <button name="save" value="1" id="save" hidden style="display: none" type="submit">finish</button>
                </form>

            </div>
        </div>
    </div>
</div>