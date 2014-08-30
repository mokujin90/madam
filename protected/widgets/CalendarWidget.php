<?php

class CalendarWidget extends CWidget{
    /**
     * @var $question Question[]
     */
    public $dayName = array("Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье");
    public $date;

    public $mondayOfWeek;

    /**
     * @var $field CompanyField[]
     */
    public $user;
    public $enableGroupEvent;
    public $shedule;

    public $mode = "day";

    public function init()
    {
        $this->enableGroupEvent = Company2License::enableGroupEvent();
        $this->date = !empty($this->date) ? $this->date : new DateTime();
        $this->shedule = $this->user->getScheduleByDay(false);

        $this->mondayOfWeek = clone $this->date;
        $day = $this->mondayOfWeek->format('N') - 1;
        $this->mondayOfWeek->modify("-$day days");
    }

    public function run()
    {
        if ($this->mode == "day") {
            $this->render('dayCalendar');
        } else {
            $this->render('weekCalendar');

        }
    }

    /**
     * @return array - массив доступных часов для событий
     */
    public function getEnableHours($dayOfWeek = null)
    {
        $dayOfWeek = $dayOfWeek !== null ? $dayOfWeek : $this->date->format('N') - 1;

        $enableHour = array();
        for ($i = 0; $i < 24; $i++) {
            $enableHour[$i] = false;
        }

        $schedule = isset($this->shedule[$dayOfWeek]) ? $this->shedule[$dayOfWeek] : array();
        foreach ($schedule as $interval) {
            for ($h = (int)$interval['startHour']; $h < (int)$interval['endHour'] + ((int)$interval['endMin'] > 0 ? 1 : 0); $h++) {
                $enableHour[$h] = true;
            }
        }
        return $enableHour;
    }

    public function getEnableHoursForWeek()
    {
        $result = array();
        foreach ($this->shedule as $day => $obj) {
            $result[$day] = $this->getEnableHours($day);
        }
        return $result;
    }

    /**
     * @return array - интервалы новых и заполненных событий
     */
    public function getEventLinks($date = null)
    {
        $date = $date ? $date : $this->date;
        $dayOfWeek = $date->format('N') - 1;

        $calendarDelimit = $this->user->calendar_delimit; //интервал на который делится календарь
        $requests = Request::getRequestWithDate($this->user->id); //события за текущий день
        $enableHour = array();
        for ($i = 0; $i < 24; $i++) { //обнуляем 24 часа
            $enableHour[$i] = array();
        }

        $dateDefault = clone $date;
        $dateDefault->setTime(0, 0, 0);

        $schedule = isset($this->shedule[$dayOfWeek]) ? $this->shedule[$dayOfWeek] : array();
        foreach ($schedule as $interval) { //заполение поинтервально (интервалы указываются в рабочем времени сотрудиника)
            $eventEnd = false;
            $dateStart = clone $dateDefault; //начинаем с начала интервала
            $dateStart->setTime((int)$interval['startHour'], (int)$interval['startMin']);
            $dateEnd = clone $dateStart;
            $dateEnd->modify("+ $calendarDelimit minutes");

            $dateEndInterval = clone $dateDefault;
            $dateEndInterval->setTime((int)$interval['endHour'], (int)$interval['endMin']);

            while ($dateEnd <= $dateEndInterval) { //пока текущий интервал-событие в пределах рабочего времени сотрудника
                $this->generateInterval($requests, $dateStart, $dateEnd, $enableHour, $eventEnd, $calendarDelimit);
            }


            if ($dateEnd != $dateEndInterval && $dateStart < $dateEndInterval) { //есть неполный интервал, наример 45 минут при часовом разделении (3:00-3:45)
                $dateEnd = $dateEndInterval;
                $this->generateInterval($requests, $dateStart, $dateEnd, $enableHour, $eventEnd, $calendarDelimit);
            }
        }


        return $enableHour;
    }

    /**
     * Создает совбодный интервал или событие из базы.
     */
    private function generateInterval($requests, &$dateStart, &$dateEnd, &$enableHour, &$eventEnd, $calendarDelimit)
    {
        foreach ($requests as $item) { //ищем брни, которые начинаются в текущем интервале-событии
            if ($item[0]->start_time == $dateStart) { //начало интервала совпало с началом брони
                foreach ($item as $eventItem) { //выводим всех людей записанных на это время
                    $enableHour[(int)$dateStart->format('H')][] = array('start' => clone $dateStart, 'end' => clone $eventItem->end_time, 'event' => $eventItem->id, 'model' => $eventItem);
                }
                if (($this->enableGroupEvent && $this->user->group_size > $this->activeCount($item)) || !$this->activeCount($item)) { //выводим бронь для нового члена группы, если остались места
                    $enableHour[(int)$dateStart->format('H')][] = array('start' => clone $dateStart, 'end' => clone $item[0]->end_time);
                }
                $eventEnd = $item[0]->end_time;
                break;
            } else if ($item[0]->start_time > $dateStart && $item[0]->start_time < $dateEnd) { //до начала брони есть участок свободного времени
                //выделяем участок свободного времени до брони в отдельный интервал-событие
                $enableHour[(int)$dateStart->format('H')][] = array('start' => clone $dateStart, 'end' => clone $item[0]->start_time);
                foreach ($item as $eventItem) { //выводим всех людей записанных на это время
                    $enableHour[(int)$dateStart->format('H')][] = array('start' => clone $eventItem->start_time, 'end' => clone $eventItem->end_time, 'event' => $eventItem->id, 'model' => $eventItem);
                }
                if (($this->enableGroupEvent && $this->user->group_size > $this->activeCount($item)) || !$this->activeCount($item)) { //выводим бронь для нового члена группы, если остались места
                    $enableHour[(int)$dateStart->format('H')][] = array('start' => clone $dateStart, 'end' => clone $item[0]->end_time);
                }
                $eventEnd = $item[0]->end_time;
                break;
            }
        }
        if ($eventEnd != false && $eventEnd < $dateEnd) { //бронь не перекрывет интервал-событие полностью
            $dateStart = clone $eventEnd;
            $eventEnd = false;
            return;
        }

        if ($eventEnd == false) { //в этом интервале-событии нет брони
            $enableHour[(int)$dateStart->format('H')][] = array('start' => clone $dateStart, 'end' => clone $dateEnd);
        }

        $dateStart = $dateEnd;

        $dateEnd = clone $dateStart;
        $dateEnd->modify("+ $calendarDelimit minutes");

        if (isset($eventEnd) && $dateEnd > $eventEnd) { //бронь закончилась в этом интервале
            if ($dateStart < $eventEnd) {
                $dateStart = clone $eventEnd;
            }
            $eventEnd = false;
        }
    }

    /**
     * @param $itemArr - массив параллельных событий
     * @return int - кол-во параллельных незаблокированных событий
     */
    private function activeCount($itemArr){
        $count = 0;
        foreach($itemArr as $item){
            if(!$item->is_block){
                $count++;
            }
        }
        return $count;
    }

    public function getEventLinksForWeek()
    {
        $result = array();
        foreach ($this->shedule as $day => $obj) {
            $date = clone $this->mondayOfWeek;
            $date->modify("+ $day days");
            $result[$day] = $this->getEventLinks($date);
        }
        return $result;
    }

    public function getEventHint($request, $required = false)
    {
        $html = '';
        foreach ($request->requestFields as $field) {
            if ($required && $field->field->type != 'required') {
                continue;
            }
            $html .= "{$field->field->name}: <b>{$field->value}</b><br>";
        }
        return $html;
    }

    public function getEventAbbr($eventModel)
    {
        $result = array();
        Request::model()->with('requestQuestions', 'requestQuestions.answer')->findByPk($eventModel->id);
        foreach ($eventModel->requestQuestions as $question) {
            if (!empty($question->answer->abbr)) {
                $result[] = $question->answer->abbr;
            }
        }
        return implode(', ', $result);
    }

    public function getEventClass($event)
    {
        $class = "event label";
        if (isset($event['event'])) {
            $class .= " has-popover";
            if (isset($_GET['target']) && $_GET['target'] == $event['event']) {
                $class .= " label-important";
            } else {
                $class .= " label-info";
            }
        } else {
            $class .= " label-success";
        }
        return $class;
    }

    public function disabledDay($enableHours)
    {
        for ($hour = 0; $hour < 24; $hour++) {
            if ($enableHours[$hour]) {
                return false;
            }
        }
        return true;
    }

    /**
     * Проверяет заблокирован ли час на протяжении всей недели.
     */
    public function disabledHour($enableHours, $hour){
        foreach($this->shedule as $day=>$obj) {
            if($enableHours[$day][$hour]){
                return false;
            }
        }
        return true;
    }

    public function isBlockIcon($model){
        return $model->is_block ? '<i class="icon-lock"></i> ' : '';
    }

    public function isRepeatIcon($model){
        return $model->repeat_event_id ? '<i class="icon-repeat"></i> ' : '';
    }

    public function getDayCalendarHourRow($hourEventInterval, $hour)
    {
        $rowArr = array();
        $rowCount = 0;
        foreach ($hourEventInterval as $event) {
            if (isset($event['event'])) {
                $rowArr[]= $this->getDayCalendarEventRow($event);
            } else {
                $rowArr[]= $this->getDayCalendarFreeRow($event);
            }
            $rowCount++;
        }
        $th = CHtml::tag('td', array('class' => 'text-center time-col', 'rowspan' => $rowCount), "$hour:00");
        $rowArr[0] = $th . (isset($rowArr[0]) ? $rowArr[0] : CHtml::tag('td', array('colspan' => 8), ''));
        $html = '';
        $firstRow = true;
        foreach ($rowArr as $row) {
            $html .= CHtml::tag('tr', $firstRow ? array('class' => 'first-row') : array(), $row);
            $firstRow = false;
        }
        return $html;
    }

    public function getEventStatus($eventModel)
    {
        $html = CHtml::tag('i', array('class' => 'icon-circle ' . Request::$statusClass[$eventModel->status]), '');
       /*if ($eventModel->is_block) {
            $html .= ' ';
            $html .= CHtml::tag('i', array('class' => 'icon-lock'), '');
        }*/

        return $html;
    }
    private function getDayCalendarEventRow($event){
        $row = CHtml::openTag('td');//cb
        $row .= CHtml::checkBox('', false, array('value' => $event['model']->id, 'class' => 'event-cb interval-cb', 'date-start' => $event['start']->format(Help::DATETIME), 'date-end' => $event['end']->format(Help::DATETIME)));
        $row .= CHtml::closeTag('td');

        $row .= CHtml::openTag('td');//status
        $row .= $this->getEventStatus($event['model']);
        $row .= CHtml::closeTag('td');

        $row .= CHtml::openTag('td');//time
        $row .= CHtml::link(
            ($this->isBlockIcon($event['model']) . $this->isRepeatIcon($event['model']) . $event['start']->format('H:i') . ' - ' . $event['end']->format('H:i')),
            array('calendar/event',
                'start' => $event['start']->format(Help::DATETIME),
                'end' => $event['end']->format(Help::DATETIME),
                'user_id' => $this->user->id,
                'id' => $event['event']
            ),
            array(
                'class' => $this->getEventClass($event),
            ));
        $row .= CHtml::closeTag('td');

        $row .= CHtml::openTag('td');//copy
        $row .= $this->getCopyLink($event);
        $row .= CHtml::closeTag('td');

        $row .= CHtml::openTag('td', array('class' => 'text-left')); //ABBR
        $row .= $this->getEventAbbr($event['model']);
        $row .= CHtml::closeTag('td');

        $row .= CHtml::openTag('td', array('class' => 'text-left')); //hint
        $row .= $this->getEventHint($event['model'], true);
        $row .= CHtml::closeTag('td');

        $row .= CHtml::openTag('td', array('class' => 'text-left')); //comment
        $row .= $event['model']->comment;
        $row .= CHtml::closeTag('td');

        $row .= CHtml::openTag('td'); //edit
        $row .= CHtml::link(
            '<i class="icon-pencil"></i>',
            array('calendar/event',
                'start' => $event['start']->format(Help::DATETIME),
                'end' => $event['end']->format(Help::DATETIME),
                'user_id' => $this->user->id,
                'id' => $event['event'],
            ),
            array(
                'class' => "event label label-info",
                'title' => Yii::t('main', 'Редактировать'),
            ));
        $row .= CHtml::closeTag('td');

        return $row;
    }
    public function getCopyLink($event){
        return CHtml::link(
            '<i class="icon-copy"></i>',
            array('calendar/event',
                'start' => $event['start']->format(Help::DATETIME),
                'end' => $event['end']->format(Help::DATETIME),
                'user_id' => $this->user->id,
                'id' => $event['event'],
                'copy' => 1,
                'edit' => 1
            ),
            array(
                'class' => "event label label-info copy-event",
                'title' => Yii::t('main', 'Копировать'),
            ));
    }
    private function getDayCalendarFreeRow($event){
        $row = CHtml::openTag('td'); //cb
        $row .= CHtml::checkBox('', false, array('class' => 'interval-cb', 'date-start' => $event['start']->format(Help::DATETIME), 'date-end' => $event['end']->format(Help::DATETIME)));
        $row .= CHtml::closeTag('td');

        $row .= CHtml::tag('td'); //status
        $row .= CHtml::openTag('td');//time

        $row .= CHtml::link(
            ($event['start']->format('H:i') . ' - ' . $event['end']->format('H:i')),
            array('calendar/event',
                'start' => $event['start']->format(Help::DATETIME),
                'end' => $event['end']->format(Help::DATETIME),
                'user_id' => $this->user->id,
                'edit' => 1
            ),
            array(
                'class' => $this->getEventClass($event),
                'data-start' => $event['start']->format(Help::DATETIME),
            ));
        $row .= CHtml::closeTag('td');
        $row .= CHtml::tag('td'); //copy
        $row .= CHtml::tag('td', array('class' => 'text-left')); //ABBR
        $row .= CHtml::tag('td', array('class' => 'text-left')); //hint
        $row .= CHtml::tag('td', array('class' => 'text-left')); //comment
        $row .= CHtml::openTag('td'); //edit
        $row .= CHtml::link(
            '<i class="icon-plus"></i>',
            array('calendar/event',
                'start' => $event['start']->format(Help::DATETIME),
                'end' => $event['end']->format(Help::DATETIME),
                'user_id' => $this->user->id,
                'edit' => 1
            ),
            array(
                'class' => $this->getEventClass($event),
                'data-start' => $event['start']->format(Help::DATETIME),
                'title' => Yii::t('main', 'Создать'),
            ));
        $row .= CHtml::closeTag('td');

        return $row;
    }

    public function getTitleWeekDate($day){
        $dateVal = clone $this->mondayOfWeek;
        $dateVal->modify("+ $day day");
        return $dateVal->format('d.m.Y');
    }
}