<div class="tab-pane <?=$active_tab == "day" ? "active" : ""?>" id="day-calendar">
    <?php $this->renderPartial('_dayCalendar',array(
    'user' => $user,
    'date' => $date,
)); ?>
</div>
<div class="tab-pane <?=$active_tab == "week" ? "active" : ""?>" id="week-calendar">
    <?php $this->renderPartial('_weekCalendar',array(
    'user' => $user,
    'date' => $date
)); ?>
</div>