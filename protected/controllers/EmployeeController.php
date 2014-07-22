<?php

class EmployeeController extends BaseController
{
    function actionCreate(){
        $this->render('employeeForm');
    }
}