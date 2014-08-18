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
        $model->user_id = $user_id;
        $companyId = Yii::app()->user->companyId;
        $question = Question::getQuestion($companyId);
        $field = CompanyField::getFieldByCompany($companyId);
        $oldBlockStatus = $model->is_block;
        if(isset($_POST['ajax'])){
            $result = array();
            $model->attributes = $_POST['event'];
            $model->user_id = $user_id; //TODO: подставить нужного
            $model->start_time = Help::formatDate($_POST['event']['date'])." ".$_POST['event']['start_time'];
            $model->end_time = Help::formatDate($_POST['event']['date'])." ".$_POST['event']['end_time'];
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
                }
                $result['redirect'] = $this->createUrl('/calendar/index',array('id' => $user_id, 'date' => Help::formatDate($_POST['event']['date']), 'target' => $model->id));
            }
            echo json_encode($result);
            Yii::app()->end();
        }
        $view = ($edit==1 || is_null($id) ) ? 'event' : 'printEvent'; //без параметра или новый выводим в виде для редактирования
        $this->render($view,array('model'=>$model,'question'=>$question,'field'=>$field,'date'=>$model->getDiscreteDate()));
    }

    public function actionTest(){
        $this->layout = 'companyLayout';
        $this->pageCaption=Yii::t('main',"Календарь");
        $this->pageIcon = 'calendar';
        $this->mainMenuActiveId="calendar";
        $this->render('test');
    }

    public function actionDelete($id){
        $model = Request::model()->findByPk($id);
        if($model){
            $model->delete();
        }
        $this->redirect(Yii::app()->request->urlReferrer);
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