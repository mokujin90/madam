<?
/**
 * @var $this CalendarWidget
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
        min-width: 120px;
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
    .event-wrap{
        width: 100%;
        max-width: 200px;
        display: inline-block;
    }
    .event-wrap .event-info{
        width: 100%;
        background-color: #ACA8DA;
        max-width: 200px;
        padding: 5px 30px 5px 5px;
        position: relative;
        text-align: left;
        display: inline-block;
    }
    .event-wrap .event-info .comment-text{
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        position: absolute;
        width: 100%;
        padding-right: 50px;
        padding-left: 30px;
        left: 20px;
    }
    .event-wrap .event-info .copy-event{
        position: absolute;
        right: 5px;
        top: 6px;
    }
    #week-calendar td{
        text-align: center;
    }
    span.th-day{
        padding-right: 12px;
    }
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

                        <span class="inline-200 th-day"><?=CHtml::checkBox('', false, array('value' => $day, 'class' => 'event-cb-day'))?> <?=$this->dayName[$day]?></span>
                        <span class="inline-200"><?=$this->getTitleWeekDate($day)?></span>
                    </th>
                <?endforeach?>
            </tr>
            </thead>
            <tbody>
            <?$eventInterval = $this->getEventLinksForWeek();?>
            <?$enable = $this->getEnableHoursForWeek();?>
            <?for($hour = 0; $hour < 24; $hour++):?>
                <?if(!$this->disabledHour($enable, $hour)):?>
                <tr>
                    <td class="col-xs-1 text-center time-col"><?=$hour?>:00</td>
                    <?foreach($this->shedule as $day=>$obj):?>
                        <?if($enable[$day][$hour]):?>
                            <td>
                                <?foreach($eventInterval[$day][$hour] as $event):?>
                                    <?if(isset($event['event'])):?>
                                        <div class="event-wrap">
                                        <?=CHtml::link(
                                            ($this->unconfirmIcon($event['model']) . $this->isRepeatIcon($event['model']) . $event['start']->format('H:i') . ' - ' . $event['end']->format('H:i')),
                                            array('calendar/event',
                                                'start' => $event['start']->format(Help::DATETIME),
                                                'end' => $event['end']->format(Help::DATETIME),
                                                'user_id' => $this->user->id,
                                                'id' =>(isset($event['event']) ? $event['event'] : 0)
                                            ),
                                            array(
                                                'class' => "inline-200 " . $this->getEventClass($event),
                                                'data-content' =>(isset($event['event']) ? ($this->getEventHint($event['model'])) : false),
                                                'data-title' => (isset($event['event']) ? ($this->getEventAbbr($event['model'])) : false),
                                                'data-placement' => 'top',
                                            ))?>
                                            <br>
                                            <div class="event-info">
                                                <?=CHtml::checkBox('', false, array('data-day' => $day, 'value' => $event['model']->id, 'class' => 'event-cb'))?>
                                                <?=$this->getEventStatus($event['model'])?>
                                                <?=$this->isBlockIcon($event['model'])?>
                                                <?=CHtml::tag('span', array('class' => 'comment-text ' . ($event['model']->is_block ? 'block-margin' : '')), $event['model']->comment);?>
                                                <?=$this->getCopyLink($event)?>
                                            </div>
                                        </div>
                                    <br>

                                    <?else:?>
                                        <?=CHtml::link(
                                            ($event['start']->format('H:i') . ' - ' . $event['end']->format('H:i')),
                                            array('calendar/event',
                                                'start' => $event['start']->format(Help::DATETIME),
                                                'end' => $event['end']->format(Help::DATETIME),
                                                'user_id' => $this->user->id,
                                                'id' =>(isset($event['event']) ? $event['event'] : 0),
                                                'edit' => 1
                                            ),
                                            array(
                                                'class' => "inline-200 " . $this->getEventClass($event),
                                            ))?>
                                        <br>
                                    <?endif;?>
                                <?endforeach?>
                            </td>
                        <?else:?>
                            <td class="disable"><span class="inline-200"><i class="icon-remove-sign"></i> Недоступно</span></td>
                        <?endif?>
                    <?endforeach?>
                </tr>
                <?endif?>
            <?endfor?>

            </tbody>
        </table>
    </div>
</div>