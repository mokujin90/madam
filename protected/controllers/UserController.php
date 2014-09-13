<?php
class UserController extends BaseController
{
    public $defaultAction = 'login';

    public $showRegisterLink = true;

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('deny',
                'actions' => array(/*'login',*/'register'),
                'users' => array('@'),
            ),
        );
    }

    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirectByRole();
        }

        $model = new LoginForm;
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login()) {
                $this->redirectByRole();
            }
        }
        $this->render('login', array('model' => $model));
    }

    public function actionNotice(){
        $this->render('emailNotice');
    }
    public function actionLogout()
    {
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionRegister(){
        $this->showRegisterLink = false;
        $user = new User('signup');
        $company = new Company();
        $country = Country::model()->findAll();

        if(Yii::app()->request->isAjaxRequest )
        {
            $user->attributes = $_POST['User'];
            $isValidation = CActiveForm::validate($user,array('login'));
            if($isValidation!='[]'){
               echo $isValidation;
                Yii::app()->end();
            }
        }
        if(isset($_POST['User']) && isset($_POST['Company'])){
            $user->attributes = $_POST['User'];
            $company->attributes = $_POST['Company'];
            if($company->save()){

                $user->is_owner = 1;
                $user->company_id = $company->id;
                if($user->password!=''){
                    $user->password = $user->getHash($user->password);
                    $user->password_repeat = $user->getHash($user->password_repeat);
                }
                if($user->save()){
                    Help::sendMail($user->login, Yii::t('main', 'Подтверждение регистрации'), 'registerConfirm', $company);
                    $identity=new UserIdentity($user->login,$user->password);
                    $identity->authenticate();
                    Yii::app()->user->login($identity,0);
                    echo CJSON::encode(array(
                        'status'=>'success',
                        'url'=>$this->createUrl('user/notice')
                    ));
                    Yii::app()->end();
                }

            }
        }
        $this->render('register', array('user' => $user,'company'=>$company,'country'=>Country::model()->getArray($country)));
    }


    public function getBreadcrumbs()
    {
        static $count = 0;
        if ($count++ > 0) {
            return parent::getBreadcrumbs();
        }

        switch ($this->action->id) {
            case 'login':
                $this->addBreadcrumb(array('name' => 'Вход'));
                break;
        }

        return parent::getBreadcrumbs();
    }
}