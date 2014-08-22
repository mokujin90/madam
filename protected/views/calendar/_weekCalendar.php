<div class="col-sm-12">
    <div class="box bordered-box blue-border" style="margin-bottom:0;">
        <div class="box-header blue-background">
            <div class="title"><?=Yii::t('main','Неделя')?> <?=Help::getDayText($date, true);?></div>
            <div class="actions">
                <div class="btn-group dropdown" style="margin-top: -10px;">
                    <button class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                        <?=Yii::t('main','Групповые действия')?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" class="block-all-action" data-block="1"><i class="icon-lock"></i> <?=Yii::t('main','Блокировать')?></a>
                        </li>
                        <li>
                            <a href="#" class="unblock-all-action" data-block="0"><i class="icon-unlock"></i> <?=Yii::t('main','Разблокировать')?></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="print-all-action"><i class="icon-print"></i> <?=Yii::t('main','Печать')?></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="export-ics-all-action" data-format="Ics"><i class="icon-download-alt"></i> <?=Yii::t('main','Экспорт *.ics')?></a>
                        </li>
                        <li>
                            <a href="#" class="export-csv-all-action" data-format="Csv"><i class="icon-download-alt"></i> <?=Yii::t('main','Экспорт *.csv')?></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="delete-all-action"><i class="icon-trash"></i> <?=Yii::t('main','Удалить')?></a>
                        </li>
                    </ul>
                </div>
                <a class="btn action-refresh btn-xs btn-link" href="#" data-date="<?=Help::getModifyDate($date, '- 1 week');?>"><i class="icon-arrow-left"></i></a>
                <a class="btn action-refresh btn-xs btn-link" href="#" data-date="<?=Help::getModifyDate($date, '+ 1 week');?>"><i class="icon-arrow-right"></i></a>
                <a class="btn action-refresh btn-xs btn-link current-date" href="#" data-date="<?=Help::getDate($date);?>"><i class="icon-refresh"></i></a>
            </div>
        </div>
        <div class="box-content box-no-padding">
            <?php $this->widget('CalendarWidget',array('user' => $user, 'mode' => 'week', 'date' => isset($date) ? $date : false)); ?>
        </div>
    </div>
</div>