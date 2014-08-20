<div class="col-xs-12">
    <?foreach ($events as $event):?>
    <?$start = new DateTime($event->start_time);?>
    <?$end = new DateTime($event->start_time);?>
        <div class="row">
            <div class="col-xs-4">
                <div class="text-contrast"><b><?=$start->format('d.m.Y')?></b></div>
                <div class="text-contrast"><?=$start->format('H:i') . ' - ' . $end->format('H:i')?></div>
                <?if($event->is_block):?>
                    <div class="text-contrast"><i class="icon-lock"></i> Событие заблокировано</div>
                <?endif?>
            </div>
            <div class="col-xs-4">
                <?foreach ($event->requestFields as $field):?>
                    <?=$field->field->name?>: <b><?=$field->value?></b><br>
                <?endforeach?>
                <?if(!empty($event->comment)):?>
                    <?=$event->comment?>
                <?endif?>
            </div>
            <div class="col-xs-4 text-right">
                <?$result = array();
                foreach ($event->requestQuestions as $question) {
                    if (!empty($question->answer->abbr)) {
                        $result[] = $question->answer->abbr;
                    }
                }?>
                <?=implode(', ', $result)?>
            </div>
        </div>
        <hr>
    <?endforeach?>
</div>
