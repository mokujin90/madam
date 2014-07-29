<div class="col-sm-12">
    <div class="box bordered-box blue-border" style="margin-bottom:0;">
        <div class="box-header blue-background">
            <div class="title"><?=Yii::t('main','Неделя')?> <?=Help::getDayText($date, true);?></div>
            <div class="actions">
                <a class="btn action-refresh btn-xs btn-link" href="#" data-date="<?=Help::getDate($date);?>"><i class="icon-refresh"></i></a>
            </div>
        </div>
        <div class="box-content box-no-padding">
            <?php $this->widget('DayCalendarWidget',array('user' => $user, 'mode' => 'week', 'date' => isset($date) ? $date : false)); ?>
        </div>
    </div>
</div>