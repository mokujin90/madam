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

        if($model->isNewRecord){
            $this->pageCaption = 'Новый работник';
        } else {
            $this->pageCaption = $model->login;
        }

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->scheduleUpdate = isset($_POST['schedule']) ? $_POST['schedule'] : array();
            $isNewRecord = $model->isNewRecord;
            if ($model->save() && $isNewRecord) { //редирект на страницу работника после создания
                $this->redirect("/employee/update/id/{$model->id}");
            }
        }

        $this->render('employeeForm', array('model' => $model));
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