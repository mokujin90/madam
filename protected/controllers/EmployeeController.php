<?php

class EmployeeController extends BaseController
{
    public function actionCreate(){
        $this->render('employeeForm');
    }

    public function actionUpdate($id){
        $model = User::model()->with('schedulesOrder')->findByPk($id);

        if (!$model) {
            throw new CHttpException(404, Yii::t('main', 'Page not found.'));
        }

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->scheduleUpdate = isset($_POST['schedule']) ? $_POST['schedule'] : array();
            $model->save();
        }

        $this->render('employeeForm', array('model' => $model));
    }

}