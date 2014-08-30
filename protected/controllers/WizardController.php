<?php

class WizardController extends BaseController
{
    public $wizardStep;

    /**
     * Сам визард
     * @param $id
     * @throws CHttpException
     */
    public function actionIndex($id){
        $this->layout='simple';
        $this->wizardStep = true;
        Question::model()->getNextQuestion($id,2,array(13),array(10));
        if( Yii::app()->request->isAjaxRequest  && isset($_POST['questionId'])){
            $next = Question::model()->getNextQuestion($id,$_POST['questionId'],Help::setArray($_POST['answerId']),$_POST['not']);
            if(!is_null($next)){
                $this->widget('WizardWidget',array('question'=>$next,'companyId'=>$id,'wizardStep'=>true,'skin'=>'oneQuestion'));
            }
            Yii::app()->end();
        }


        $company = Company::model()->with('country')->findByPk($id);
        if(is_null($company))
            throw new CHttpException(404, Yii::t('main', 'Страница не найдена'));
        $question = $this->wizardStep ? Help::setArray(Question::model()->getNextQuestion($id)) : Question::getQuestion($id); //todo: изменить

        $fields = CompanyField::getActiveField($id);
        if(isset($_POST['save'])){
            //test
            $startTime = '2014-08-25 10:20:00';
            $endTime = '2014-08-25 11:20:00';
            if( !is_null($request=Request::create(array('user_id'=>17,'start_time'=>$startTime,'end_time'=>$endTime))) ){
                RequestQuestion::createByPost($_POST['answer'],$request->id);
                RequestField::createByPost($_POST['field'],$request->id);
                $this->redirect(Yii::app()->createUrl('site/panel',array('status'=>'1')));
            }
        }
        $this->render('index',array('company'=>$company,'question'=>$question,'field'=>$fields));
    }
    /**
     * Метод, который расчитает время на входе у него полузаполненная форма, где в ключе "answer" лежат заполненные ответы
     * @param $get
     */
    public function actionTime($get){
        if(Yii::app()->request->isAjaxRequest && isset($_GET['get'])){
            $companyId = $_POST['companyId'];

            $answers = RequestField::model()->getAnswerByPost($_POST['answer']);
            $time = Answer::model()->getTime($answers);
            $result=array('time'=>$time,'user_id'=>json_encode(User2Answer::model()->getNeedUser(Help::decorate($answers,'id'),$companyId)));
            echo json_encode($result);
            Yii::app()->end();
        }
    }

}