<?
/**
 * @var $this DayCalendarWidget
 */
?>
<style>
    .disable-hour td{
        color:#B94A48;
        font-size: 12px;
        vertical-align: middle;
    }
    .disable-hour td.time-col{
        text-decoration: line-through;
        font-size: 14px;
    }
    .time-col{
        background: #D9EDF7 !important;
        color: #3A87AD;
    }
    #week-calendar .inline-200{
        display: inline-block;
        width: 100%;
        max-width: 200px;
        text-align: center;
    }
    #week-calendar .disable{
        color:#B94A48;
        font-size: 12px;
        vertical-align: middle;
    }
    .label-success[href]:hover, .label-success[href]:focus,
    .label-info[href]:hover, .label-info[href]:focus {
        background-color: #31b0d5; }
</style>
<div class="responsive-table">
    <div class="scrollable-area">
        <table class="table" style="margin-bottom:0;">
            <thead>
            <tr>
                <th class="col-xs-1 text-center time-col">
                    Time
                </th>
                <?foreach($this->shedule as $day=>$obj):?>
                    <th>
                        <span class="inline-200"><?=$this->dayName[$day]?></span>
                    </th>
                <?endforeach?>
            </tr>
            </thead>
            <tbody>
            <?$eventInterval = $this->getEventLinksForWeek();?>
            <?$enable = $this->getEnableHoursForWeek();?>
            <?for($hour = 0; $hour < 24; $hour++):?>
                <?=CHtml::openTag('tr')?>
                    <td class="col-xs-1 text-center time-col"><?=$hour?>:00</td>
                    <?foreach($this->shedule as $day=>$obj):?>
                        <?if($enable[$day][$hour]):?>
                            <td>
                                <?foreach($eventInterval[$day][$hour] as $event):?>
                                <?=CHtml::link(
                                    ($event['start']->format('H:i') . ' - ' . $event['end']->format('H:i')),
                                    array('calendar/event',
                                        'start' => $event['start']->format(Help::DATETIME),
                                        'end' => $event['end']->format(Help::DATETIME),
                                        'user_id' => $this->user->id,
                                        'id' =>(isset($event['event']) ? $event['event'] : 0)
                                    ),
                                    array(
                                        'class' => "inline-200 " . $this->getEventClass($event),
                                        'data-start' => $event['start']->format(Help::DATETIME),
                                        'data-end' => $event['end']->format(Help::DATETIME),
                                        'data-id' =>(isset($event['event']) ? $event['event'] : false)
                                    ))?>
                                <br>
                                <?endforeach?>
                            </td>
                        <?else:?>
                            <td class="disable"><span class="inline-200"><i class="icon-remove-sign"></i> Недоступно</span></td>
                        <?endif?>
                    <?endforeach?>
                <?=CHtml::closeTag('tr')?>
            <?endfor?>

            </tbody>
        </table>
    </div>
</div>