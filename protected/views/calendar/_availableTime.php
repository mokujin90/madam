<div class="responsive-table">
<div class="scrollable-area">

<table class="table" style="margin-bottom:0;">
    <thead>
    <tr>
        <th class="col-xs-1 text-center time-col">
            Time
        </th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?for($hour = 0; $hour < 24; $hour++):?>
    <?if(count($eventInterval[$hour])):?>
    <tr>
        <td class="col-xs-1 text-center time-col"><?=$hour?>:00</td>
        <td>
            <?foreach($eventInterval[$hour] as $events):?>
                <?=CHtml::tag('label',
                    array(
                        'class' => "event label label-success",
                        'data-start' => $events[0]['start']->format(Help::DATETIME),
                        'data-end' => $events[0]['end']->format(Help::DATETIME),
                        'data-user-id' => $this->getUserIdJson($events)
                    ),
                    CHtml::radioButton('start_time', false, array('class' => 'time-selection', 'id' => false, 'value' => $events[0]['start']->format(Help::DATETIME))) . ' ' . ($events[0]['start']->format('H:i') /*. ' - ' . $events[0]['end']->format('H:i') . (count($events) > 1 ? ('<i class="icon-remove"></i>' . count($events)) : '')*/)
            )?>
            <?endforeach?>
        </td>
    </tr>
        <?endif?>
    <?endfor?>
    </tbody>
</table>
</div>
</div>