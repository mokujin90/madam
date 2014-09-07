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
    public function actionRequestPayment()
    {
        $e=new ExpressCheckout;

        $products=array(

            '0'=>array(
                'NAME'=>'p1',
                'AMOUNT'=>'250.00',
                'QTY'=>'2'
            ),
            '1'=>array(
                'NAME'=>'p2',
                'AMOUNT'=>'300.00',
                'QTY'=>'2'
            ),
            '2'=>array(
                'NAME'=>'p3',
                'AMOUNT'=>'350.00',
                'QTY'=>'2'
            ),

        );
        /*Optional */
        $shipping_address=array(

            'FIRST_NAME'=>'Sirin',
            'LAST_NAME'=>'K',
            'EMAIL'=>'sirinibin2006@gmail.com',
            'MOB'=>'0918606770278',
            'ADDRESS'=>'mannarkkad',
            'SHIPTOSTREET'=>'mannarkkad',
            'SHIPTOCITY'=>'palakkad',
            'SHIPTOSTATE'=>'kerala',
            'SHIPTOCOUNTRYCODE'=>'IN',
            'SHIPTOZIP'=>'678761'
        );

        $e->setShippingInfo($shipping_address); // set Shipping info Optional

        $e->setCurrencyCode("EUR");//set Currency (USD,HKD,GBP,EUR,JPY,CAD,AUD)

        $e->setProducts($products); /* Set array of products*/

        $e->setShippingCost(5.5);/* Set Shipping cost(Optional) */


        $e->returnURL=Yii::app()->createAbsoluteUrl("site/PaypalReturn");

        $e->cancelURL=Yii::app()->createAbsoluteUrl("site/PaypalCancel");

        $result=$e->requestPayment();

        /*
          The response format from paypal for a payment request
        Array
    (
        [TOKEN] => EC-9G810112EL503081W
        [TIMESTAMP] => 2013-12-12T10:29:35Z
        [CORRELATIONID] => 67da94aea08c3
        [ACK] => Success
        [VERSION] => 65.1
        [BUILD] => 8725992
    )
            */


        if(strtoupper($result["ACK"])=="SUCCESS")
        {
            /*redirect to the paypal gateway with the given token */
            header("location:".$e->PAYPAL_URL.$result["TOKEN"]);
        }



    }
}