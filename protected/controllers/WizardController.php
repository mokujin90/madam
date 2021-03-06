<?php

class WizardController extends BaseController
{
    const STATUS_WIZARD_OK=1;
    const STATUS_WIZARD_ERROR=3;
    public $layout='simple';
    public $wizardStep;

    /**
     * Сам визард
     * @param $id
     * @throws CHttpException
     */
    public function actionIndex($id){


        if( Yii::app()->request->isAjaxRequest  && isset($_POST['questionId'])){
            $next = Question::model()->getNextQuestion($id,$_POST['questionId'],Help::setArray($_POST['answerId']),isset($_POST['not']) ? $_POST['not'] : array());
            if(!is_null($next)){
                $this->widget('WizardWidget',array('question'=>$next,'companyId'=>$id,'wizardStep'=>true,'skin'=>'oneQuestion','showAgree'=>true));
            }
            Yii::app()->end();
        }


        $company = Company::model()->with('country')->findByPk($id);
        if(is_null($company))
            throw new CHttpException(404, Yii::t('main', 'Страница не найдена'));
        $license = Company2License::getCurrentLicense($id);
        $this->wizardStep = $license['license']->control_dialog == 1 ? true :false;
        $question = $this->wizardStep ? Help::setArray(Question::model()->getNextQuestion($id)) : Question::getQuestion($id); //todo: изменить

        $fields = CompanyField::getActiveField($id);
        if(isset($_POST['save'])){
            $errorString = '';
            if(isset($_POST['requestId'])){
                $oldRequest = Request::model()->findByPk($_POST['requestId']);
                $oldRequest->delete();
            }
            $emplyeeId = $_POST['employee_id'];
            $startTime = $_POST['start_time'];
            $requestData = json_decode($_POST['jsonResult'],true);
            $endTime = new DateTime($_POST['start_time']);
            $endTime->add(new DateInterval('PT' . ($requestData['time'] == 0 ? 1 : $requestData['time']) . 'M'));
            $confirm = (($license['license']->email_confirm == 1 || $license['license']->sms_confirm == 1) && $company->enable_confirm) ? 0 : 1;
            $alarmMin = $_POST['Request']['alarm_time'];
            $request=Request::create(array('user_id'=>$emplyeeId,'start_time'=>$startTime,'end_time'=>$endTime->format(Help::DATETIME),'is_confirm'=>$confirm,'comment'=>$_POST['Request']['comment'],'alarm_time'=>$alarmMin));
            if( !is_null($request->id)){
                RequestQuestion::createByPost($_POST['answer'],$request->id);
                RequestField::createByPost($_POST['field'],$request->id);
                $request->sendNotification($license['license']->email_confirm == 1);
                $request->sendSmsNotification($license['license']->sms_confirm == 1);
                $status = self::STATUS_WIZARD_OK;//
            }
            else{
                $errors = $request->getErrors();
                foreach($errors as $field){
                    foreach($field as $error){
                        $errorString .=htmlspecialchars($error);
                    }
                }
                $errorString = str_replace('/', ",", $errorString);

                $status = self::STATUS_WIZARD_ERROR;//
            }
            $this->redirect(Yii::app()->createUrl('site/panel',array('status'=>$status,'errors'=>$errorString)));

        }
        $info = Distance::getDistance($id);
        $this->render('index',array('company'=>$company,'question'=>$question,'field'=>$fields,'info'=>$info,'showAgree'=>$this->wizardStep));
    }

    /**
     * Экшн, который выдаст часть верстки на основе первых трех шагов визарда
     * @param $fakePost экшн может выполняться как экшн, работющий с постом, или же с массивом переданным в него
     */
    public function actionTotal($fakePost=null){

        $request = !is_null($fakePost) ? $fakePost : $_POST;

        $model = isset($request['requestId']) ? Request::model()->findByPk($request['requestId']) : new Request();
        //if(Yii::app()->request->isAjaxRequest && isset($request['companyId'])){
            Help::recommend($request['answer']);
            /*время*/
            $date = $_POST['start_time'];
            $user = User::model()->findByPk($_POST['employee_id']);
            $requestData = json_decode($_POST['jsonResult'],true);
            $delay = $requestData['time'];
            Help::recommend($request['answer']);
            /*все о компании*/
            $company = Company::model()->with('country')->findByPk($request['companyId']);
            /*вопросы и ответы*/
            $questions = Question::model()->findAllByAttributes(array('id'=>array_keys($request['answer'])));
            $answers = RequestQuestion::getAnswerByPost($request['answer']);
            /*поля*/
            Help::recommend($request['field']);
            $fieldText = array_filter($request['field']); //пустые уберем
            $fields = CompanyField::model()->findAllByAttributes(array('id'=>array_keys($fieldText)),array('index'=>'id'));
            /*юридическая информация*/
            $info = Distance::getDistance($request['companyId']);

            $this->renderPartial('total',array('request'=>$model,'date'=>$date,'company'=>$company,'questions'=>$questions,'answers'=>$answers,'fieldText'=>$fieldText,'fields'=>$fields,'info'=>$info,'user'=>$user,'delay'=>$delay));

    }
    public function actionIframe(){
        $this->render('test');
    }
    public function actionEdit($id,$hash,$delete=0){
        $request = Request::model()->with('requestFields','requestQuestions','user')->findByPk($id);
        if(is_null($request)){
            throw new CHttpException(404, Yii::t('main', 'Событие не найдено'));
        }
        else if($request->getHash()!=$hash){
            throw new CHttpException(403, Yii::t('main', 'Неверный хеш'));
        }
        if($delete==1){
            $request->delete();
            $this->render('delete');
        }
        else{
            //т.к. у нас на входе только id реквеста и его хеш определим компанию по полю user_id
            $companyId = $request['user']->company_id;
            $company = Company::model()->with('country','users')->findByPk($companyId);
            $questionId = Help::decorate($request['requestQuestions'],'question_id','question_id');
            $question = Question::model()->with('answers')->findAllByAttributes(array('id'=>$questionId),array('index'=>'id','order'=>"position"));

            $fields = CompanyField::getActiveField($companyId);
            $info = Distance::getDistance($companyId);

            $license = Company2License::getCurrentLicense($company->id);
            $this->wizardStep = $license['license']->control_dialog == 1 ? true :false;
            $this->render('index',array('company'=>$company,'question'=>$question,'field'=>$fields,'info'=>$info,'request'=>$request,'showAgree'=>false));
        }

    }
    /**
     * Метод, который расчитает время на входе у него полузаполненная форма, где в ключе "answer" лежат заполненные ответы
     * @param $get
     */
    public function actionTime($get){
        if(Yii::app()->request->isAjaxRequest && isset($_GET['get'])){
            $companyId = $_POST['companyId'];
            $answers = RequestQuestion::model()->getAnswerByPost($_POST['answer']);
            $schedule2answer = Shedule2Answer::getScheduleByAnswer(Help::decorate($answers,'id'),$companyId);
            $time = Answer::model()->getTime($answers);
            $result=array('time'=>$time,'schedule_id'=>json_encode($schedule2answer),'user_id'=>json_encode(User2Answer::model()->getNeedUser(Help::decorate($answers,'id'),$companyId)));
            echo json_encode($result);
            Yii::app()->end();
        }
    }

    public function actionTest(){
        $req = Request::model()->findByPk(292);
        $this->render('/mailer/notification', array('request' => $req));
    }

    public function actionConfirm($id, $hash, $delete = 0, $external = 1){
        $request = Request::model()->findByPk($id);
        if(is_null($request)){
            throw new CHttpException(404, Yii::t('main', 'Событие не найдено'));
        }
        else if($request->getLightHash()!=$hash){
            throw new CHttpException(403, Yii::t('main', 'Неверный хеш'));
        }
        if($request->is_confirm == 1){
            throw new CHttpException(403, Yii::t('main', 'Событие уже подтверждено'));
        }
        $mail = $request->getEmailField();
        $phone = $request->getPhoneField();
        if ($delete) {
            $request->delete();
            Help::sendMail($mail, Yii::t('main','Уведомление о удалении termin'), 'unconfirmed', $request);
            Help::sendSms($phone, Yii::t('main','Ваш termin был удален'), $request);
        } else {
            $request->is_confirm = 1;
            $request->save(false);
            Help::sendMail($mail, Yii::t('main','Уведомление о создании termin'), 'notification', $request);
            Help::sendSms($phone, Help::genSmsText($request), $request);
        }
        if($external){
            $this->redirect(Yii::app()->createUrl('site/panel',array('status'=>'2')));
        } else {
            $this->redirect('/calendar/index/id/'.$request->user_id);
        }

    }

    public function actionPrint($id,$hash){
        $model = Request::model()->with('requestFields','requestQuestions','user')->findByPk($id);
        if(is_null($model)){
            throw new CHttpException(404, Yii::t('main', 'Событие не найдено'));
        }
        else if($model->getHash()!=$hash){
            throw new CHttpException(403, Yii::t('main', 'Неверный хеш'));
        }
        $user = User::model()->findByPk($model->user_id);
        $company = Company::model()->findByPk($user->company_id);
        /*вопросы и ответы*/
        $questions = Question::model()->findAllByAttributes(array('id'=>Help::decorate($model['requestQuestions'],'question_id')));
        $answers = Answer::model()->findAllByAttributes(array('id'=>Help::decorate($model['requestQuestions'],'answer_id')));
        /*поля*/
        $field = CompanyField::model()->findAllByAttributes(array('id'=>Help::decorate($model['requestFields'],'field_id')));
        $fieldText = Help::decorate($model['requestFields'],'value','field_id');
        /*разница*/
        $start = date_create($model->start_time);
        $end = date_create($model->end_time);
        $interval = date_diff($end, $start);
        $this->render('print',array('request'=>$model,'date'=>$model->start_time,'company'=>$company,'questions'=>$questions,'answers'=>$answers,'fieldText'=>$fieldText,'fields'=>$field,'user'=>$user,'delay'=>$interval->format('%I')));
    }

    public function actionExport($id, $hash)
    {
        $event = Request::model()->findByPk($id);
        if(!$event)
            throw new CHttpException(404, Yii::t('main', 'Компания не найдена'));
        elseif($hash!=$event->getHash())
            throw new CHttpException(403, Yii::t('main', 'Хеш устарел'));
        $content = '';
        $createDate = new DateTime($event->create_date);
        $startDate = new DateTime($event->start_time);
        $endDate = new DateTime($event->end_time);
        $content .= BaikalEvent::geniCal($event, $createDate, $startDate, $endDate, true) . "\n";
        $content = "BEGIN:VCALENDAR\nVERSION:2.0\nMETHOD:PUBLISH\n" . $content . "END:VCALENDAR";
        $date = new DateTime();

        header("Cache-Control: public");
        header("Content-Type: application/octet-stream; ");
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment;filename="'.'TerminExport' . $date->format('YmdHis') . '.ics'.'"');
        header('Cache-Control: max-age=0');
        echo $content;
    }

    public function actionResponseSms($message_id = 12345, $message = 'message', $from = '12345', $ref = false){
        if (!$sms = Sms::model()->with('user')->findByAttributes(array('message_id' => $message_id))) {
            return;
        }
        $model = array();
        $model['sms'] = $sms;
        $model['reply'] = array(
            'message' => $message,
            'from' => $from
        );


        Help::sendMail($sms->user->login, Yii::t('main', 'Ответ на SMS уведомление'), 'smsReply', $model);
    }
}