<?php

class CalendarController extends BaseController
{
	public function actionIndex()
	{
        $this->layout = 'companyLayout';


        $user = User::model()->findByPk(19);

		$this->render('index', array('user' => $user));
	}
}