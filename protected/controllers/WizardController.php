<?php

class WizardController extends BaseController
{
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
        $license = Company2License::getCurrentLicense();
        $this->wizardStep = $license['license']->control_dialog == 1 ? true :false;
        $question = $this->wizardStep ? Help::setArray(Question::model()->getNextQuestion($id)) : Question::getQuestion($id); //todo: изменить

        $fields = CompanyField::getActiveField($id);
        if(isset($_POST['save'])){
            if(isset($_POST['requestId'])){
                $oldRequest = Request::model()->findByPk($_POST['requestId']);
                $oldRequest->delete();
            }
            $emplyeeId = $_POST['employee_id'];
            $startTime = $_POST['start_time'];
            $requestData = json_decode($_POST['jsonResult'],true);
            $endTime = new DateTime($_POST['start_time']);
            $endTime->add(new DateInterval('PT' . ($requestData['time'] == 0 ? 1 : $requestData['time']) . 'M'));

            if( !is_null($request=Request::create(array('user_id'=>$emplyeeId,'start_time'=>$startTime,'end_time'=>$endTime->format(Help::DATETIME)))) ){
                RequestQuestion::createByPost($_POST['answer'],$request->id);
                RequestField::createByPost($_POST['field'],$request->id);
                $this->redirect(Yii::app()->createUrl('site/panel',array('status'=>'1')));
            }
        }
        $info = Distance::getDistance($id);
        $this->render('index',array('company'=>$company,'question'=>$question,'field'=>$fields,'info'=>$info,'showAgree'=>$this->wizardStep));
    }

    /**
     * Экшн, который выдаст часть верстки на основе первых трех шагов визарда
     */
    public function actionTotal(){

        $request = $_POST;

        //if(Yii::app()->request->isAjaxRequest && isset($request['companyId'])){
            Help::recommend($request['answer']);
            /*время*/
            $date = $_POST['start_time'];

            $user = User::model()->findByPk($_POST['employee_id']);
            $requestData = json_decode($_POST['jsonResult'],true);
        //$delay =$requestData[''];
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

            $this->renderPartial('total',array('date'=>$date,'company'=>$company,'questions'=>$questions,'answers'=>$answers,'fieldText'=>$fieldText,'fields'=>$fields,'info'=>$info,'user'=>$user,'delay'=>$delay));

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
            //throw new CHttpException(403, Yii::t('main', 'Неверный хеш'));
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

            $license = Company2License::getLicenseBycompany($company->id);
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
            $time = Answer::model()->getTime($answers);
            $result=array('time'=>$time,'user_id'=>json_encode(User2Answer::model()->getNeedUser(Help::decorate($answers,'id'),$companyId)));
            echo json_encode($result);
            Yii::app()->end();
        }
    }

    public function actionTest(){
        $req = Request::model()->findByPk(281);
        $this->render('/mailer/notification', array('request' => $req));
    }

}