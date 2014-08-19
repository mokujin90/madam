<div class="col-xs-12 col-sm-8">
    <div class="form-group">
        <label class="col-xs-4 control-label">Ответы, одобрены для графика</label>
        <div class="col-xs-8">
            <div class="radio">
                <?php echo CHtml::radioButton('User[all_answers]',$model->all_answers==1?true:false,array('id'=>'option_all_answer','value'=>1,'class'=>'user-type-answer'))?>
                <?php echo CHtml::label(Yii::t('main','Все ответы'),'option_all_answer');?>
            </div>
            <div class="radio">
                <?php echo CHtml::radioButton('User[all_answers]',$model->all_answers!=1?true:false,array('id'=>'optionsRadios2','value'=>0,'class'=>'user-type-answer'))?>
                <?php echo CHtml::label(Yii::t('main','Определенные ответы'),'optionsRadios2');?>
            </div>
        </div>
    </div>
    <div id="user-answer" style="<?if($model->all_answers==1):?>display: none;<?endif?>">
    <?foreach($question as $item):?>
        <div class="form-group">
            <label class="col-xs-4 control-label"><?=$item->text?></label>
            <div class="col-xs-8">
                <?foreach($item['answers'] as $answer):?>
                <div class="checkbox">
                    <label>
                        <?=CHtml::checkBox('question['.$answer->id.'][]',isset($user2answer[$answer->id])?true:false)?><?=$answer->text?>
                    </label>
                </div>
                <?endforeach?>
            </div>
        </div>
        <?endforeach;?>
    </div>
</div>
<div class="col-xs-12 col-sm-4">

</div>