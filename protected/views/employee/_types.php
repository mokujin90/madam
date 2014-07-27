<div class="col-xs-12 col-sm-8">
    <div class="hidden form-group">
        <label class="col-xs-4 control-label">Ответы, одобрены для графика</label>
        <div class="col-xs-8">
            <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                    Все ответы
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                    Определенные ответы
                </label>
            </div>
        </div>
    </div>
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
<div class="col-xs-12 col-sm-4">

</div>