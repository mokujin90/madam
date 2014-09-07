<?php

class CalendarController extends BaseController
{
	public function actionIndex($id, $date = null)
	{
        $this->layout = 'companyLayout';
        $this->pageCaption=Yii::t('main',"Календарь");
        $this->pageIcon = 'calendar';
        $this->mainMenuActiveId="calendar";

        $user = User::model()->findByPk($id);
        if (!$user) {
            throw new CHttpException(404, Yii::t('main', 'Page not found.'));
        }
        if(isset($date)){
            $date = new DateTime($date);
        }
        $find = new Find();
        if(isset($_POST['search']) && Yii::app()->request->isAjaxRequest){
            $_POST['Find']['startDate'] = !empty($_POST['Find']['startDate']) ? Help::formatDate($_POST['Find']['startDate']) : null;
            $_POST['Find']['endDate'] = !empty($_POST['Find']['endDate']) ? Help::formatDate($_POST['Find']['endDate']) : null;
            $find->attributes = $_POST['Find'];
            $find->userId = $id;
            $result = $find->search($id);
            echo $this->renderPartial('_findResult', array('findResult' => $result));
            Yii::app()->end();
        }
        if (!empty($_GET['target']) && !empty($_GET['repeatRemove'])) {
            if ($event = Request::model()->findByPk($_GET['target'])) {
                foreach(Request::model()->findAllByAttributes(array('repeat_event_id' => $event->id)) as $eventItem){
                    $eventItem->delete();
                }
            }
        }
		$this->render('index', array('user' => $user, 'date' => $date,'find'=>$find));
	}

    /**
     * @param null $id Id собатия, в том случае если мы редактируем уже созданный
     * @param null $start дата начала события, если мы создаем
     * @param null $end
     * @param $user_id
     * @param null $copy
     */
    public function actionEvent($id=null,$start=null,$end=null,$user_id, $copy = null,$edit=0){
        $this->blockJquery();
        if(empty($id)){//если создаем новую запись вставим из get'a дату начала и конца
            $model = new Request();
            $model->start_time = is_null($start) ? Help::currentDate() : $start;
            $model->end_time = is_null($end) ? Help::currentDate() : $end;
        }
        else{ #заберем данные о редактируемом событии с вопросами и полями, на которые уже отвечали
            $model = Request::model()->with('requestFields','requestQuestions')->findByPk($id);
            if (!empty($copy)) {
                $modelCopy = new Request();
                $modelCopy->attributes = $model->attributes;
                $modelCopy['requestQuestions'] = $model['requestQuestions'];
                $modelCopy['requestFields'] = $model['requestFields'];
                $model = $modelCopy;
            }
        }
        $companyId = Yii::app()->user->companyId;
        if(!$model->checkAccess(array('company_id'=>$companyId,'user_id'=>$user_id)))
            Yii::app()->end('Доступ запрещен');
        $model->user_id = $user_id;



        $question = Question::getQuestion($companyId);
        $field = CompanyField::getFieldByCompany($companyId);
        $oldBlockStatus = $model->is_block;
        if(isset($_POST['ajax'])){
            $result = array();
            $model->attributes = $_POST['event'];
            $model->user_id = $user_id; //TODO: подставить нужного
            $model->start_time = Help::formatDate($_POST['event']['date'])." ".$_POST['event']['start_time'];
            $model->end_time = Help::formatDate($_POST['event']['date'])." ".$_POST['event']['end_time'];
            $model->is_block = isset($_POST['event']['is_block']) ? $_POST['event']['is_block'] : 0;
            $repeatErrors = array();
            $isValidate = !($model->is_block==1 && $oldBlockStatus==0);
            //валидируем только тогда, когда мы не пытаемся заблокировать запись
            if(!$model->validate() && $isValidate){
                $result['error']=$this->drawError($model->getErrors());
            }
            else{
                if($model->save($isValidate)){
                    $model->clearQuestionAndField();
                    RequestQuestion::createByPost($_POST['answer'],$model->id);
                    RequestField::createByPost($_POST['field'],$model->id);
                    BaikalEvent::updateEvent($model->id);
                    if (isset($_POST['repeat']) && !empty($_POST['repeat_booking'])) {
                        $repeatErrors = $model->createRepeatEvents($_POST['repeat']);
                    }
                }
                $result['repeatErrors'] = $repeatErrors;
                $result['removeRedirect'] = $this->createUrl('/calendar/index',array('repeatRemove' => 1, 'id' => $user_id, 'date' => Help::formatDate($_POST['event']['date']), 'target' => $model->id));
                $result['redirect'] = $this->createUrl('/calendar/index',array('id' => $user_id, 'date' => Help::formatDate($_POST['event']['date']), 'target' => $model->id));
            }
            echo json_encode($result);
            Yii::app()->end();
        }
        $view = ($edit==1 || is_null($id) ) ? 'event' : 'printEvent'; //без параметра или новый выводим в виде для редактирования
        $this->render($view,array('model'=>$model,'question'=>$question,'field'=>$field,'date'=>$model->getDiscreteDate()));
    }

    public function actionNotice($id,$user_id){
        $this->blockJquery();
        $user = User::model()->findByPk($user_id);
        $model = Request::model()->findByPk($id);
        if (isset($_POST['save'])) {

            $return = array('message' => 'Ошибка отправки');
            if ($_POST['save'] == "mail" && !empty($_POST['mail_text'])) {
                if (Help::sendMail($model->getEmailField(), 'Termin Mail', $_POST['mail_text'], $model)) {
                    $return = array('message' => 'Письмо отправлено');
                }
            } elseif ($_POST['save'] == "sms" && !empty($_POST['sms_text'])) {
                if (Help::sendSms($model->getPhoneField(), $_POST['sms_text'], $model)) {
                    $return = array('message' => 'SMS отправлено');
                }
            }
            echo json_encode($return);
            return;
        }
        $this->render('notice',array('model'=>$model,'user'=>$user));

    }
    public function actionGroupBlockEvent($block)
    {
        $events = Request::model()->findAllByPk($_REQUEST['id']);
        foreach ($events as $event) {
            if ($event->is_block != $block) {
                $event->is_block = $block;
                $event->save();
            }
        }
    }

    public function actionGroupDeleteEvent()
    {
        $events = Request::model()->findAllByPk($_REQUEST['id']);
        foreach ($events as $event) {
            $event->delete();
        }
    }

    public function actionGroupPrintEvent()
    {
        $events = Request::model()->with('requestQuestions', 'requestQuestions.answer', 'requestFields', 'requestFields.field')->findAllByPk($_REQUEST['id'], array('order' => 'start_time'));
        echo $this->renderPartial('_printEventList', array('events' => $events));
    }

    public function actionGroupExportIcsEvent()
    {
        $events = Request::model()->findAllByPk($_REQUEST['id']);
        $content = '';
        foreach($events as $event){
            $createDate = new DateTime($event->create_date);
            $startDate = new DateTime($event->start_time);
            $endDate = new DateTime($event->end_time);
            $content .= BaikalEvent::geniCal($event, $createDate, $startDate, $endDate, true) . "\n";
        }
        $content = "BEGIN:VCALENDAR\nVERSION:2.0\nMETHOD:PUBLISH\n" . $content . "END:VCALENDAR";
        $date = new DateTime();
        $this->export('TerminExport' . $date->format('YmdHis') . '.ics', $content);
    }

    public function actionGroupExportCsvEvent()
    {
        $events = Request::model()->findAllByPk($_REQUEST['id'], array('order' => 'start_time'));
        $header = array(
            Yii::t('main', 'Дата'),
            Yii::t('main', 'Начало'),
            Yii::t('main', 'Конец'),
            Yii::t('main', 'Статус'),
        );
        $companyFields = CompanyField::model()->findAllByAttributes(array('company_id' => Yii::app()->user->companyId, 'type' => array('required', 'enabled')));
        foreach ($companyFields as $field) {
            $header[] = $field->name;
        }
        $header[] = Yii::t('main', 'Комментарий');
        $content =  implode(';', $header) . ";\n";
        foreach ($events as $event) {
            $startDate = new DateTime($event->start_time);
            $endDate = new DateTime($event->end_time);

            $row = array();
            $row[] = $startDate->format('d/m/Y');
            $row[] = $startDate->format('H:i');
            $row[] = $endDate->format('H:i');
            $row[] = Request::$status[$event->status];
            foreach ($companyFields as $field) {
                $exist = false;
                foreach($event->requestFields as $rfield){
                    if($rfield->field_id == $field->id){
                        $exist = true;
                        $row[] = $rfield->value;
                    }
                }
                if (!$exist) {
                    $row[] = "";
                }
            }
            $row[] = $event->comment;

            $content .= implode(';', $row) . ";\n";
        }
        $date = new DateTime();
        $this->export('TerminExport' . $date->format('YmdHis') . '.csv', $content);
    }
    private function export($fileName, $content){
        header("Cache-Control: public");
        header("Content-Type: application/octet-stream; ");
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment;filename="'.$fileName.'"');
        header('Cache-Control: max-age=0');
        echo $content; //тут достаточно вывести получившийся файл
    }

    public function actionDelete($id)
    {
        $model = Request::model()->findByPk($id);
        if ($model) {
            $model->delete();
        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionChangeCalendarDate($user_id, $date, $active_tab = 'day')
    {
        $user = User::model()->findByPk($user_id);
        if (!$user) {
            echo Yii::t('main', 'Пользователь не существует');
        } else {
            $date = new DateTime($date);
            echo $this->renderPartial('_ajaxCalendar', array('user' => $user, 'date' => $date, 'active_tab' => $active_tab));
        }
    }

    public function actionGetUserList($id){
        $user = User::model()->findAllByAttributes(array('id' => json_decode($id)));
        if (!count($user)) {
            echo Yii::t('main', 'Пользователь не существует');
        } else {
            echo $this->renderPartial('_userList', array('user' => $user));
        }
    }

    public function actionGetAvailableTime($date, $id, $schedule_id, $duration = 30){
        $user = User::model()->findAllByAttributes(array('id' => json_decode($id)));
        if (!count($user)) {
            echo Yii::t('main', 'Пользователь не существует');
        } else {
            $date = new DateTime($date);
            $availableInterval = array();
            foreach($user as $item){
                $schedule = $item->getScheduleByDay(false, true, json_decode($schedule_id));
                $availableInterval[$item->id] = $this->getAvailableIntervals($date, $item, $schedule, $duration);
                //$availableInterval = $this->getAvailableIntervals($date, $item, $schedule, $duration);
            }
            for ($i = 0; $i < 24; $i++) { //обнуляем 24 часа
                $enableHour[$i] = array();
            }
            foreach($availableInterval as $item){
                foreach($item as $hour=>$intervals){
                    foreach($intervals as $intervalItem){
                        $enableHour[$hour][$intervalItem['start']->format('U')][] = $intervalItem;
                    }
                    ksort($enableHour[$hour]);
                }
            }
            echo $this->renderPartial('_availableTime', array('user' => $user, 'eventInterval' => $enableHour));
        }
    }

    public $enableGroupEvent = true;
    private function getAvailableIntervals($date, $user, $userSchedule, $duration)
    {
        $duration = $duration ? $duration : 1; //продолжительность не может быть нулевой. Error Protect.
        $dayOfWeek = $date->format('N') - 1;

        $calendarDelimit = $user->calendar_front_delimit < 0 ? 10 : $user->calendar_front_delimit; //интервал на который делится календарь
        $requests = Request::getRequestWithDate($user->id); //события за текущий день
        $enableHour = array();
        for ($i = 0; $i < 24; $i++) { //обнуляем 24 часа
            $enableHour[$i] = array();
        }

        $dateDefault = clone $date;
        $dateDefault->setTime(0, 0, 0);

        $deadlineDefault = clone $date;

        $now = new DateTime();
        if($now->format('Y-m-d') == $dateDefault->format('Y-m-d')){
            $frontDelimit = $user->calendar_front_delimit ? $user->calendar_front_delimit : 1;
            $min = ceil($now->format('i') / $frontDelimit) * $frontDelimit;
            $deadlineDefault->modify("+ " . $now->format('H') . " hours");
            $deadlineDefault->modify("+ $min minutes");
            $deadlineDefault->modify("+ {$user->company->booking_deadline} hours");
        }

        $schedule = isset($userSchedule[$dayOfWeek]) ? $userSchedule[$dayOfWeek] : array();
        foreach ($schedule as $interval) { //заполение поинтервально (интервалы указываются в рабочем времени сотрудиника)
            $eventEnd = false;
            $dateStart = clone $dateDefault; //начинаем с начала интервала
            $dateStart->setTime((int)$interval['startHour'], (int)$interval['startMin']);

            if($dateStart < $deadlineDefault){
                $dateStart = clone $deadlineDefault;
            }
            $dateEnd = clone $dateStart;
            $dateEnd->modify("+ $duration minutes");

            $dateEndInterval = clone $dateDefault;
            $dateEndInterval->setTime((int)$interval['endHour'], (int)$interval['endMin']);

            while ($dateEnd <= $dateEndInterval) { //пока текущий интервал-событие в пределах рабочего времени сотрудника
                $this->generateInterval($requests, $dateStart, $dateEnd, $enableHour, $eventEnd, $calendarDelimit, $duration, $user->group_size,  $user->id);
            }


            /*if ($dateEnd != $dateEndInterval && $dateStart < $dateEndInterval) { //есть неполный интервал, наример 45 минут при часовом разделении (3:00-3:45)
                $dateEnd = $dateEndInterval;
                $this->generateInterval($requests, $dateStart, $dateEnd, $enableHour, $eventEnd, $calendarDelimit, $duration);
            }*/
        }

        return $enableHour;
    }

    /**
     * Создает совбодный интервал или событие из базы.
     */
    private function generateInterval($requests, &$dateStart, &$dateEnd, &$enableHour, &$eventEnd, $calendarDelimit, $duration, $group_size, $id)
    {
        foreach ($requests as $item) { //ищем брни, которые начинаются в текущем интервале-событии
            if ($item[0]->start_time >= $dateStart && $item[0]->start_time < $dateEnd) {
                $length = $item[0]->end_time->format('U') -  $item[0]->start_time->format('U');
                if(
                    $length == $duration * 60 &&
                    $this->enableGroupEvent &&
                    $group_size > count($item)
                ) {
                    $enableHour[(int)$dateStart->format('H')][$item[0]->start_time->format('U')] = array('start' => clone $item[0]->start_time, 'end' => clone $item[0]->end_time, 'event' => true, 'id' => $id);
                }
                $eventEnd = $item[0]->end_time;
                break;
            }
        }
        /*if ($eventEnd != false && $eventEnd < $dateEnd) { //бронь не перекрывет интервал-событие полностью
            $dateStart = clone $eventEnd;
            $eventEnd = false;
            return;
        }*/

        if ($eventEnd == false) { //в этом интервале-событии нет брони
            $enableHour[(int)$dateStart->format('H')][$dateStart->format('U')] = array('start' => clone $dateStart, 'end' => clone $dateEnd, 'id' => $id);
        }

        $dateStart->modify("+ $calendarDelimit minutes");

        $dateEnd = clone $dateStart;
        $dateEnd->modify("+ $duration minutes");

        if (isset($eventEnd) && $dateStart >= $eventEnd) { //бронь закончилась в этом интервале
            $eventEnd = false;
        }
    }

    public function getUserIdJson($events){
        $result = array();
        foreach($events as $event){
            $result[] = $event['id'];
        }
        return json_encode($result);
    }
}