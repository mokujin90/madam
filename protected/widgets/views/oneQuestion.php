<?
/**
 * @var $this WizardWidget
 */
?>
<div class="question" data-question = "<?=$question->id?>">
    <div class="col-xs-12">
        <label class="control-label"><?=$question->text?></label>
    </div>
    <div class="col-xs-11 col-xs-offset-1">
        <?=$question->hint?>
    </div>
    <div class="col-xs-11 col-xs-offset-1">
        <div class="form-group">
            <?
                if(!$request->isNewRecord){
                    $answer = Help::decorate($request['requestQuestions'],'answer_id','answer_id');
                    echo $this->drawAnswer($question,$answer);
                }
                else{
                   echo $this->drawAnswer($question);
                }

            ?>
        </div>
    </div>
    <?if($this->wizardStep && $question->issetNext()):?>
        <button class="agree btn">Следующий вопрос</button>
    <?endif;?>
</div>