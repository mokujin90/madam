<?php

class CalendarController extends BaseController
{
	public function actionIndex()
	{
        $this->layout = 'companyLayout';

        $user = User::model()->findByPk(19);

		$this->render('index', array('user' => $user));
	}

    public function actionEvent($id=null,$start=null,$end=null,$userId=2){
        $this->blockJquery();
        if(empty($id)){//если создаем новую запись вставим из get'a дату начала и конца
            $model = new Request();
            $model->start_time = is_null($start) ? Help::currentDate() : $start;
            $model->end_time = is_null($end) ? Help::currentDate() : $end;
        }
        else{ #заберем данные о редактируемом событии с вопросами и полями, на которые уже отвечали
            $model = Request::model()->with('requestFields','requestQuestions')->findByPk($id);
        }
        $companyId = Yii::app()->user->companyId;
        $question = Question::getQuestion($companyId);
        $field = CompanyField::getFieldByCompany($companyId);
        if(isset($_POST['save'])){
            $model->user_id = $userId; //TODO: подставить нужного
            $model->start_time = $_POST['event']['date']." ".$_POST['event']['start_time'];
            $model->end_time = $_POST['event']['date']." ".$_POST['event']['end_time'];
            if($model->save()){
                $model->clearQuestionAndField();
                RequestQuestion::createByPost($_POST['answer'],$model->id);
                RequestField::createByPost($_POST['field'],$model->id);
            }
            $this->redirect(Yii::app()->request->urlReferrer);
        }
        $this->render('event',array('model'=>$model,'question'=>$question,'field'=>$field,'date'=>$model->getDiscreteDate()));
    }

    public function actionTest(){
        $this->layout = 'simple';
        $this->render('test');
    }
}