<?
/**
 * @var $this CalendarWidget
 */
?>
<style>
    .table thead > tr > th,
    .table thead > tr > th, .table thead > tr > td, .table tbody > tr > th, .table tbody > tr > td, .table tfoot > tr > th, .table tfoot > tr > td{
        border-color: #ADD2E7;
    }
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
    .event-wrap{
        margin: 10px 0;
        border-bottom: 1px solid #DDD;
        padding-bottom: 10px;
    }
    .event-begin{
        border-bottom: 1px solid #DDD;
        height: 10px;
        margin-bottom: 20px;
        padding-left: 10px;
    }
    .event-content{
        padding-left: 10px;
    }
</style>
<div class="responsive-table">
    <div class="scrollable-area">
        <?$eventInterval = $this->getEventLinks();?>
        <?$enable = $this->getEnableHours();?>
        <table class="table" style="margin-bottom:0;">
            <thead>
            <?if(!$this->disabledDay($enable)):?>
                <tr>
                    <th class="col-xs-1 text-center time-col">
                        Time
                    </th>
                    <th></th>
                </tr>
            <?endif?>
            </thead>
            <tbody>
            <?for($hour = 0; $hour < 24; $hour++):?>
                <?if(!$enable[$hour]) continue;?>
                <tr>
                    <td class="col-xs-1 text-center time-col"><?=$hour?>:00</td>
                    <td>
                        <?foreach($eventInterval[$hour] as $event):?>
                            <?if(isset($event['event'])):?>
                            <div class="event-wrap">
                                <div class="event-begin">
                                    <?=CHtml::link(
                                    ($this->isBlockIcon($event['model']) . $event['start']->format('H:i') . ' - ' . $event['end']->format('H:i')),
                                    array('calendar/event',
                                        'start' => $event['start']->format(Help::DATETIME),
                                        'end' => $event['end']->format(Help::DATETIME),
                                        'user_id' => $this->user->id,
                                        'id' =>$event['event']
                                    ),
                                    array(
                                        'class' => $this->getEventClass($event),
                                    ))?>

                                    <?=CHtml::link(
                                    '<i class="icon-copy"></i>',
                                    array('calendar/event',
                                        'start' => $event['start']->format(Help::DATETIME),
                                        'end' => $event['end']->format(Help::DATETIME),
                                        'user_id' => $this->user->id,
                                        'id' => $event['event'],
                                        'copy' => 1
                                    ),
                                    array(
                                        'class' => "event label label-info",
                                        'title' => Yii::t('main', 'Копировать'),
                                    ))?>
                                </div>
                                <div class="event-content">
                                    <?=$this->getEventHint($event['model'], true)?>
                                </div>
                            </div>
                            <?else:?>
                                <?=CHtml::link(
                                    ($event['start']->format('H:i') . ' - ' . $event['end']->format('H:i')),
                                    array('calendar/event',
                                        'start' => $event['start']->format(Help::DATETIME),
                                        'end' => $event['end']->format(Help::DATETIME),
                                        'user_id' => $this->user->id,
                                    ),
                                    array(
                                        'class' => $this->getEventClass($event),
                                        'data-start' => $event['start']->format(Help::DATETIME),
                                    ))?>
                            <?endif?>
                        <?endforeach?>
                    </td>
                    <!--td>
                        <div class="text-right">
                            <a class="btn btn-success btn-xs" href="#">
                                <i class="icon-ok"></i>
                            </a>
                            <a class="btn btn-danger btn-xs" href="#">
                                <i class="icon-remove"></i>
                            </a>
                        </div>
                    </td-->
                </tr>
            <?endfor?>
            <?if($this->disabledDay($enable)):?>
                <tr>
                    <td class="text-center">Расписание отсутсвует.</td>
                </tr>
            <?endif?>
            </tbody>
        </table>
    </div>
</div>