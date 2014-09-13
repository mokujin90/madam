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
    .table thead > tr > th, .table thead > tr > td, .table tbody > tr > th, .table tbody > tr > td, .table tfoot > tr > th, .table tfoot > tr > td{
        border: 1px solid #ADD2E7;
    }
    .first-row td{
        border-top-width: 2px !important;
    }
    .time-col{
        border-top-width: 2px !important;
        border-bottom-width: 2px !important;
    }
    td.text-left{
        white-space: normal !important;
    }
</style>
<div class="responsive-table">
    <div class="scrollable-area">
        <?$eventInterval = $this->getEventLinks();?>
        <?$enable = $this->getEnableHours();?>
        <table class="table text-center" style="margin-bottom:0;">
            <thead>
            <?if(!$this->disabledDay($enable)):?>
                <tr>
                    <th class="col-xs-1 text-center time-col">
                        Time
                    </th>
                    <th class="text-center"><input class="event-cb-all" type="checkbox"></th>
                    <th></th>
                    <th><?=Yii::t('main','Интервал')?></th>
                    <th></th>
                    <th class="col-xs-2"></th>
                    <th class="col-xs-3"><?=Yii::t('main','Информация')?></th>
                    <th class="col-xs-3"><?=Yii::t('main','Комментарий')?></th>
                    <th></th>
                </tr>
            <?endif?>
            </thead>
            <tbody>
            <?for($hour = 0; $hour < 24; $hour++):?>
                <?if(!$enable[$hour]) continue;?>
                <tr>
                    <?=$this->getDayCalendarHourRow($eventInterval[$hour], $hour)?>
                </tr>
            <?endfor?>
            <?if($this->disabledDay($enable)):?>
                <tr>
                    <td class="text-center"><?= Yii::t('main','Расписание отсутсвует.')?></td>
                </tr>
            <?endif?>
            </tbody>
        </table>
    </div>
</div>