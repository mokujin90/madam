<?
/**
 * @var $this DayCalendarWidget
 */
?>
<style>
    .disable-hour td{
        color:#B94A48;
    }
    .disable-hour td.time-col{
        text-decoration: line-through;
    }
    .time-col{
        background: #D9EDF7 !important;
        color: #3A87AD;
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
                <th>
                    E-mail
                </th>
                <th>
                    Status
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?$eventInterval = $this->getEventLinks();?>
            <?$enable = $this->getEnableHours();?>
            <?for($hour = 0; $hour < 24; $hour++):?>
                <?=CHtml::openTag('tr', array('class' => !$enable[$hour] ? 'disable-hour' : false))?>
                    <td class="col-xs-1 text-center time-col"><?=$hour?>:00</td>
                    <?if($enable[$hour]):?>
                        <td>
                            <?foreach($eventInterval[$hour] as $event):?>
                                <?=CHtml::link(
                                    ($event['start']->format('H:i') . ' - ' . $event['end']->format('H:i')),
                                    array('calendar/event',
                                        'start' => $event['start']->format(Help::DATETIME),
                                        'end' => $event['end']->format(Help::DATETIME),
                                        'id' =>(isset($event['event']) ? $event['event'] : 0)
                                    ),
                                    array(
                                        'class' => ("event label label-success " .(isset($event['event']) ? "label-info" : '')),
                                        'data-start' => $event['start']->format(Help::DATETIME),
                                        'data-end' => $event['end']->format(Help::DATETIME),
                                        'data-id' =>(isset($event['event']) ? $event['event'] : false)
                                    ))?>
                            <?endforeach?>
                        </td>
                        <td></td>
                        <td>
                            <div class="text-right">
                                <!--a class="btn btn-success btn-xs" href="#">
                                    <i class="icon-ok"></i>
                                </a>
                                <a class="btn btn-danger btn-xs" href="#">
                                    <i class="icon-remove"></i>
                                </a-->
                            </div>
                        </td>
                    <?else:?>
                        <td colspan="3"><i class="icon-remove-sign"></i> Недоступно</td>
                    <?endif?>

                <?=CHtml::closeTag('tr')?>
            <?endfor?>

            </tbody>
        </table>
    </div>
</div>