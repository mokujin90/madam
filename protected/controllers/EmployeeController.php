<?php

class EmployeeController extends BaseController{

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'employee';
        $this->pageIcon = 'user';

        return true;
    }

    public function actionUpdate($id = null)
    {

        $model = isset($id) ? User::model()->findByPk($id) : new User();

        if (!$model) {
            throw new CHttpException(404, Yii::t('main', 'Page not found.'));
        }
        else if($model->company_id != Yii::app()->user->companyId){
            throw new CHttpException(403, Yii::t('main', 'Доступ запрещен.'));
        }

        if($model->isNewRecord){
            $this->pageCaption = 'Новый работник';
            if (!Company2License::enableNewEmployee()) {
                $this->render('employeeLimit');
                return;
            }
        } else {
            $this->pageCaption = $model->login;
        }

        $companyId = Yii::app()->user->companyId;
        $question = Question::getQuestion($companyId);

        if (isset($_POST['User'])) {
            $oldPwd = $model->password;
            $model->attributes = $_POST['User'];
            if(!$model->isNewRecord){
                $model->password = $model->password == '' ? $oldPwd : $model->getHash();
            }
            else if($model->password != ''){
                $model->password = $model->getHash();
            }
            $model->scheduleUpdate = isset($_POST['schedule']) ? $_POST['schedule'] : array();
            $model->answered = isset($_POST['question']) ? $_POST['question'] : array();
            $isNewRecord = $model->isNewRecord;

            if ($model->save() && $isNewRecord) { //редирект на страницу работника после создания
                $this->redirect("/employee/update/id/{$model->id}");
            }
        }
        $user2answer = $model->isNewRecord ? array() : User2Answer::getAnswerByUser($model->id);
        $this->render('index', array('model' => $model,'question'=>$question,'user2answer'=>$user2answer));
    }

    public function actionDelete($id = null)
    {
        $model = User::model()->findByPk($id);

        if (!$model) {
            throw new CHttpException(404, Yii::t('main', 'Page not found.'));
        }

        $model->delete();
        $this->redirect("/employee/create");
    }
}