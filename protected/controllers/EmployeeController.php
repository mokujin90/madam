<?php

class EmployeeController extends BaseController
{
    public function actionCreate(){
        $this->render('employeeForm');
    }
}