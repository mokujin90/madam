<?php

class WizardController extends BaseController
{
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