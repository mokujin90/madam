<?php

class AdminUserController extends AdminBaseController{

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->layout='adminLayout';
        return true;
    }

    public function actionIndex()
    {
        $this->mainMenuActiveId = 'user';
        $this->pageCaption = 'User';

        $model = new User('search');
        $model->unsetAttributes();
        if(isset($_GET['User']))
            $model->attributes=$_GET['User'];

        $this->render('/admin/user',array('model' => $model,));
    }

    /**
     * Экшон, с помощью которого можно будет зайти под другим пользователем
     * @param $id
     */
    public function actionLogin($id){
        $user = User::model()->findByPk($id);
        $identity = UserIdentity::createAuthenticatedIdentity($user);

        $identity->authenticate(true);

        if ($identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = 3600 * 24 * 30; // 30 days
            Yii::app()->user->login($identity, $duration);
            Yii::app()->user->setState('__id',$id);
        }
        $this->redirect($this->createUrl('calendar/index',array('id'=>$id)));
    }

}