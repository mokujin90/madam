<?php

class AdminLicenseController extends AdminBaseController{

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->layout='adminLayout';
        return true;
    }

    public function actionIndex()
    {
        $this->mainMenuActiveId = 'baseLicense';
        $this->pageCaption = 'Base License';

        $licenses = License::model()->system()->findAll();
        $this->render('/admin/baseLicense',array('licenses'=>$licenses));
    }

    public function actionCreate()
    {
        $model=new License;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['License']))
        {
            $model->attributes=$_POST['License'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    public function actionEdit($id)
    {
        $model=$this->loadModel('License',null,$id);
        if(isset($_POST['License']))
        {
            $model->attributes=$_POST['License'];
            if($model->save())
                $this->redirect(isset($_POST['url_referrer'])? $_POST['url_referrer'] : Yii::app()->request->urlReferrer);
        }

        $this->render('/admin/licenseEdit',array(
            'model'=>$model,
        ));
    }

    public function actionDelete($id){
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }


}