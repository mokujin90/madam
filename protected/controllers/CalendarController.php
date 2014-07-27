<?php

class CalendarController extends BaseController
{
	public function actionIndex()
	{
        $this->layout = 'simple';
		$this->render('index');
	}
}