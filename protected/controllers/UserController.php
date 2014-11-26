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
        $json = array('error' => '[]', 'status' => false, 'url' => $this->createUrl('/'));
        if (Yii::app()->request->isAjaxRequest) {
            $json['error'] = CActiveForm::validate($model);
            if ($json['error'] == '[]') {
                if ($model->validate() && $model->login()) {
                    $json['url'] = $this->userUrlByRole();
                    $json['status'] = true;
                }
            }
            $this->renderJSON($json);
            return;
        }
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login()) {
                $this->redirectByRole();
            }
        }
        $this->layout = '//layouts/landing';
        $this->render('/site/login', array('model' => $model));
    }

    public function actionNotice($id){
        $user = User::model()->findByPk($id);
        if (!$user) {
            throw new CHttpException(404, Yii::t('main', 'Пользователь не найден'));
        }
        Help::sendMail($user->login, Yii::t('main', 'Подтверждение регистрации'), 'registerConfirm', $user->company);
        $this->layout = '//layouts/landing';
        $this->render('/site/emailNotice');
    }

    public function actionLogout()
    {
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionRegister(){
        $this->showRegisterLink = false;
        $user = new User('signup');
        $company = new Company('signup');
        $country = Country::model()->findAllByAttributes(array(),array('index'=>'id'));

        if(Yii::app()->request->isAjaxRequest )
        {
            $user->attributes = $_POST['User'];
            $company->attributes = $_POST['Company'];
            $isValidation = CActiveForm::validate($user,array('login', 'password', 'password_repeat'));
            $companyValidation = CActiveForm::validate($company);
            if($isValidation!='[]' || $companyValidation!='[]'){
                echo $result = json_encode(array_merge(json_decode($isValidation, true),json_decode($companyValidation, true)));
                Yii::app()->end();
            }
        }
        if(isset($_POST['User']) && isset($_POST['Company'])){
            $user->attributes = $_POST['User'];
            $company->attributes = $_POST['Company'];
            $company->language_id = $country[$company->country_id]->language_id;
            if($company->country_id==2){
                $company->phone_code = "49";
            }
            if($company->save()){

                $user->is_owner = 1;
                $user->company_id = $company->id;
                if($user->password!=''){
                    $user->password = $user->getHash($user->password);
                    $user->password_repeat = $user->getHash($user->password_repeat);
                }
                if($user->save()){
                    echo CJSON::encode(array(
                        'status'=>'success',
                        'url'=>$this->createUrl('user/notice',array('id'=>$user->id))
                    ));
                    Yii::app()->end();
                }

            }
        }
        $this->layout = '//layouts/landing';
        $this->menuItem = 'register';
        $this->render('/site/register', array('user' => $user,'company'=>$company,'country'=>Country::model()->getArray($country)));
    }


    public function getBreadcrumbs()
    {
        static $count = 0;
        if ($count++ > 0) {
            return parent::getBreadcrumbs();
        }

        switch ($this->action->id) {
            case 'login':
                $this->addBreadcrumb(array('name' => Yii::t('main','Вход')));
                break;
        }

        return parent::getBreadcrumbs();
    }
}