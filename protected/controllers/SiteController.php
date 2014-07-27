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
    public function actionPanel($status=null){
        $this->layout='simple';

        $this->render('index',array('status'=>$status));
    }
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{

        //$this->layout = '//layouts/column1';

		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$this->render('index');
	    $this->redirect('user/login');
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

    public function actionCompany($id){//todo:fake
        $this->layout='simple';
        $company = Company::model()->with('country')->findByPk($id);
        if(is_null($company))
            throw new CHttpException(404, Yii::t('main', 'Страница не найдена'));
        $question = Question::getQuestion($id);
        $fields = CompanyField::getActiveField($id);
        if(isset($_POST['save'])){
            if( !is_null($request=Request::create(array('user_id'=>2,'start_time'=>Help::currentDate(),'end_time'=>Help::currentDate() ))) ){
                RequestQuestion::createByPost($_POST['answer'],$request->id);
                RequestField::createByPost($_POST['field'],$request->id);
                $this->redirect(Yii::app()->createUrl('site/panel',array('status'=>'1')));
            }
        }
        $this->render('requestWizard',array('company'=>$company,'question'=>$question,'field'=>$fields));
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
}