<?php

class CalendarController extends BaseController
{
	public function actionIndex($id)
	{
        $this->layout = 'companyLayout';
        $this->pageCaption=Yii::t('main',"Календарь");
        $this->pageIcon = 'calendar';
        $this->mainMenuActiveId="calendar";

        $user = User::model()->findByPk($id);
        if (!$user) {
            throw new CHttpException(404, Yii::t('main', 'Page not found.'));
        }

		$this->render('index', array('user' => $user));
	}

    public function actionEvent($id=null,$start=null,$end=null){
        $this->blockJquery();
        if(empty($id)){//если создаем новую запись вставим из get'a дату начала и конца
            $model = new Request();
            $model->start_time = $start;
            $model->end_time = $end;

        }
        else{
            $model = Request::model()->findByPk($id);
        }
        $companyId = Yii::app()->user->companyId;
        $question = Question::getQuestion($companyId);
        $field = CompanyField::getFieldByCompany($companyId);
        if(isset($_POST['save'])){
            $model->user_id = 1; //TODO: подставить нужного
            $model->start_time = $_POST['event']['date']." ".$_POST['event']['start_time'];
            $model->end_time = $_POST['event']['date']." ".$_POST['event']['end_time'];
            if($model->save()){
                RequestQuestion::createByPost($_POST['answer'],$model->id);
                RequestField::createByPost($_POST['field'],$model->id);
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        }
        $this->render('event',array('model'=>$model,'question'=>$question,'field'=>$field));
    }

    public function actionTest(){
        $this->layout = 'simple';
        $this->render('test');
    }

    public function actionChangeCalendarDate($user_id, $date, $active_tab = 'day'){
        $user = User::model()->findByPk($user_id);
        if (!$user) {
            echo Yii::t('main', 'Пользователь не существует');
        } else {
            $date = new DateTime($date);
            echo $this->renderPartial('_ajaxCalendar', array('user' => $user, 'date' => $date, 'active_tab' => $active_tab));
        }
    }
}