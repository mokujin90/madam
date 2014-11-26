<?php

class SiteController extends BaseController
{
    public function filters()
    {
        return array();
    }

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}
    public function actionPanel($status=null,$errors=''){
        $this->layout='simple';

        $this->render('panel',array('status'=>$status,'errorString'=>$errors));
    }
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $this->menuItem = 'index';
        $this->layout = '//layouts/landing';
        $this->render('index');
        //$this->redirect('user/login');
    }
    public function actionApport()
    {
        $this->menuItem = 'apport';
        $this->layout = '//layouts/landing';
        $this->render('apport');
    }
    public function actionPrice()
    {
        $this->menuItem = 'price';
        $this->layout = '//layouts/landing';
        $stdLicense = License::getStandardLicense();
        $this->render('price', array('stdLicense' => $stdLicense));
    }
    public function actionMore()
    {
        $this->layout = '//layouts/landing';
        $this->render('more');
    }
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}



	/**
	 * Displays the contact page
	 */
	/*public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}*/


    public function getBreadcrumbs()
    {
        static $count = 0;
        if ($count++ > 0) {
            return parent::getBreadcrumbs();
        }

        switch ($this->action->id) {
            case 'error':
                $this->addBreadcrumb(array('name' => 'Ошибка'));
                break;
        }

        return parent::getBreadcrumbs();
    }

    public function actionCompanyConfirm($id,$hash){
        $company = Company::model()->findByPk($id);
        if(is_null($company))
            throw new CHttpException(404, Yii::t('main', 'Компания не найдена'));
        elseif($hash!=$company->getHash())
            throw new CHttpException(403, Yii::t('main', 'Хеш устарел'));
        $company->is_confirmed = 1;
        $company->create_date = Help::currentDate();//переписываем дату, ведь отсчитываться время пользование лицензии будет от сюда
        $company->save();
        $this->redirectByRole();
    }

    public function actionAutoLogin($id,$hash){
        $user = User::model()->findByPk($id);
        if(is_null($user))
            throw new CHttpException(404, Yii::t('main', 'Пользователь не найден'));
        elseif($hash != $user->password)
            throw new CHttpException(403, Yii::t('main', 'Хеш устарел'));
        $identity = UserIdentity::createAuthenticatedIdentity($user);

        $identity->authenticate(true);

        if ($identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = 3600 * 24 * 30; // 30 days
            Yii::app()->user->login($identity, $duration);
            Yii::app()->user->setState('__id',$id);
        }
        $this->redirect('/');
    }
}