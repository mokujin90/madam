<?php
class AdminController extends AdminBaseController
{
    public $defaultAction = 'index';

    public function actionIndex()
    {
        echo 'OK';
    }

    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirectByRole();
        }
        $form = new AdminLoginForm;

        if (isset($_POST['AdminLoginForm'])) {
            $form->attributes = $_POST['AdminLoginForm'];
            if ($form->validate()) {
                $this->redirectByRole();
            }
        }
        $this->render('login', array('form' => $form));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionSetting(){
        $this->layout='adminLayout';
        $this->mainMenuActiveId='setting';
        $language = Help::decorate(Language::model()->findAll(),'name');
        if(isset($_POST['Root'])){
            $this->user->attributes = $_POST['Root'];
            $this->user->save();

        }
        $this->render('setting',array('model'=>$this->user,'language'=>$language));
    }
}

?>
