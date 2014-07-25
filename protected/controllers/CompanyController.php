<?php

class CompanyController extends BaseController
{
    public function actionIndex()
    {
        $this->pageCaption="Данные о компании";
        $this->pageIcon = 'terminal';
        $this->mainMenuActiveId="company";

        $id = Yii::app()->user->companyId;
        $model = Company::model()->findByPk($id);
        $country = Country::model()->findAll(array('index'=>'id'));
        if($_POST['save']==1 && count($_POST['Company'])){
            $model->attributes = $_POST['Company'];
            $model->save();
        }
        $this->render('index',array('model'=>$model,'country'=>$country));
    }

    public function actionSettings()
    {
        $this->pageCaption="Настройки";
        $this->mainMenuActiveId="settings";

        $id = Yii::app()->user->companyId;
        $model = Company::model()->findByPk($id);

        if (isset($_POST['Company'])) {
            $model->attributes = $_POST['Company'];
            $model->save();
        }

        $this->render('settings', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Company']))
        {
            $model->attributes=$_POST['Company'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }
}