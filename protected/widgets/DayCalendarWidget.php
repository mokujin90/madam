<?php

class DayCalendarWidget extends CWidget{
    /**
     * @var $question Question[]
     */
    public $date;

    /**
     * @var $field CompanyField[]
     */
    public $user;
    public $shedule;

    public function init()
    {
        $this->date = new DateTime();
        $this->date->modify('+ 1 day');
        $this->shedule = $this->user->getScheduleByDay();
    }

    public function run()
    {
        $this->render('dayCalendar');
    }

    /**
     * @return array - массив доступных часов для событий
     */
    public function getEnableHours() {
        $dayOfWeek = $this->date->format('N') - 1;

        $enableHour = array();
        for($i = 0; $i < 24; $i++){
            $enableHour[$i] = false;
        }

        $schedule = isset($this->shedule[$dayOfWeek]) ? $this->shedule[$dayOfWeek] : array();
        foreach($schedule as $interval) {
            for($h = (int)$interval['startHour']; $h < (int)$interval['endHour'] + 1; $h++){
                $enableHour[$h] = true;
            }
        }
        return $enableHour;
    }

    /**
     * @return array - интервалы новых и заполненных событий
     */
    public function getEventLinks() {
        $dayOfWeek = $this->date->format('N') - 1;
        $calendarDelimit = $this->user->calendar_delimit; //интервал на который делится календарь
        $requests = Request::getRequestWithDate(); //события за текущий день
        $enableHour = array();
        for ($i = 0; $i < 24; $i++) { //обнуляем 24 часа
            $enableHour[$i] = array();
        }

        $dateDefault = new DateTime();
        $dateDefault->setTime(0,0,0);

        $schedule = isset($this->shedule[$dayOfWeek]) ? $this->shedule[$dayOfWeek] : array();
        foreach($schedule as $interval) { //заполение поинтервально (интервалы указываются в рабочем времени сотрудиника)
            $eventEnd = false;
            $dateStart = clone $dateDefault; //начинаем с начала интервала
            $dateStart->setTime((int)$interval['startHour'], (int)$interval['startMin']);
            $dateEnd = clone $dateStart;
            $dateEnd->modify("+ $calendarDelimit minutes");

            $dateEndInterval = clone $dateDefault;
            $dateEndInterval->setTime((int)$interval['endHour'], (int)$interval['endMin']);

            while ($dateEnd <= $dateEndInterval) { //пока текущий интервал-событие в пределах рабочего времени сотрудника
                $this->generateInterval($requests, &$dateStart, &$dateEnd, &$enableHour, &$eventEnd, $calendarDelimit);
            }


            if($dateEnd != $dateEndInterval && $dateStart < $dateEndInterval){ //есть неполный интервал, наример 45 минут при часовом разделении (3:00-3:45)
                $dateEnd = $dateEndInterval;
                $this->generateInterval($requests, &$dateStart, &$dateEnd, &$enableHour, &$eventEnd, $calendarDelimit);
            }
        }


        return $enableHour;
    }

    /**
     * Создает совбодный интервал или событие из базы.
     */
    private function generateInterval($requests, $dateStart, $dateEnd, $enableHour, $eventEnd, $calendarDelimit){
        foreach($requests as $item) { //ищем брни, которые начинаются в текущем интервале-событии
            if ($item->start_time == $dateStart) { //начало интервала совпало с началом брони
                $enableHour[(int)$dateStart->format('H')][] = array('start' => clone $dateStart, 'end' => clone $item->end_time, 'event' => $item->id);
                $eventEnd = $item->end_time;
                break;
            } else if ($item->start_time > $dateStart && $item->start_time < $dateEnd) { //до начала брони есть участок свободного времени
                //выделяем участок свободного времени до брони в отдельный интервал-событие
                $enableHour[(int)$dateStart->format('H')][] = array('start' => clone $dateStart, 'end' => clone $item->start_time);
                $enableHour[(int)$dateStart->format('H')][] = array('start' => clone $item->start_time, 'end' => clone $item->end_time, 'event' => $item->id);
                $eventEnd = $item->end_time;
                break;
            }
        }
        if($eventEnd != false && $eventEnd < $dateEnd) { //бронь не перекрывет интервал-событие полностью
            $dateStart = clone $eventEnd;
            $eventEnd = false;
            return;
        }

        if($eventEnd == false) { //в этом интервале-событии нет брони
            $enableHour[(int)$dateStart->format('H')][] = array('start' => clone $dateStart, 'end' => clone $dateEnd);
        }

        $dateStart = $dateEnd;

        $dateEnd = clone $dateStart;
        $dateEnd->modify("+ $calendarDelimit minutes");

        if(isset($eventEnd) && $dateEnd > $eventEnd){ //бронь закончилась в этом интервале
            if($dateStart < $eventEnd){
                $dateStart = clone $eventEnd;
            }
            $eventEnd = false;
        }
    }
}