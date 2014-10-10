<?php

class BaseController extends CController
{
    public $layout = '//layouts/column2';

    protected $_breadcrumbs = array();

    public $mailer;
    public $user;
    public $company;
    public $mainMenuActiveId;
    public $pageCaption = '';
    public $pageIcon = 'cog';

    const DEFAULT_LANG = 'de';
    public function init()
    {
        header('Content-Type: text/html; charset=utf-8');
/*
        $this->mailer =& Yii::app()->mailer;
        $this->mailer->CharSet = 'windows-1251';
        $this->mailer->From = Yii::app()->params['fromEmail'];
        $this->mailer->FromName = iconv("UTF-8", "windows-1251", Yii::app()->params['fromName']);*/

        if (!Yii::app()->user->isGuest) {
            $this->user = User::model()->findByPk(Yii::app()->user->id);

        }
        $this->checkLanguage();
        parent::init();
    }

    public function checkLanguage(){

        if(!Yii::app()->user->isGuest){
            $this->company = Company::model()->with('lang')->findByPk($this->user->company_id);
            $language = count($this->company['lang']) ? $this->company['lang']->prefix : Language::$DEFAULT;
        }
        else{
            $language=self::DEFAULT_LANG;
        }
        Yii::app()->language = $language;

        new JsTrans('main',$language);
    }
    public function filters()
    {
        return array(
            'accessControl',
            //'roleAccessControl'
        );
    }

   public function accessRules()
    {
        return array(
            array('allow',
                'controllers' => array('wizard'),
                ),
            array('allow',
                'actions' => array('getAvailableTime', 'getUserList'),
            ),
            array('deny',
                'controllers' => array('company', 'employee', 'requestForm'),
                'expression' => '($user->getOwner() == 0)'
            ),
            array('allow',
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }


    /*public function filterRoleAccessControl($filterChain)
    {
        if (!$this->user) {
            Yii::app()->user->logout(false);
            Yii::app()->user->loginRequired();
        }

        $allowed = false;

        if (Yii::app()->user->checkAccess($this->id . 'Controller')) {
            $allowed = true;
        } else {
            $action = $this->action ? $this->action->id : null;
            if ($action && Yii::app()->user->checkAccess($this->id . '.' . $action)) {
                $allowed = true;
            }
        }
        if (!$allowed) {
            throw new CHttpException(403, Yii::t('yii', 'You are not authorized to perform this action.'));
        } else {
            $filterChain->run();
        }
    }*/

    public function redirectByRole()
    {
        if (Yii::app()->user->owner) {
            $this->redirect('/company');
        } else {
            $this->redirect('/calendar/index/id/' . Yii::app()->user->id);
        }
        //$this->redirect('/');
    }

    public function getBreadcrumbs()
    {
        return array_merge(array(array('name' => 'Главная', 'url' => '/')), $this->_breadcrumbs);
    }

    public function addBreadcrumb($value)
    {
        $this->_breadcrumbs = array_merge($this->_breadcrumbs, array($value));
    }

    public function getPageTitle()
    {
        $path = array();
        $breadcrumbs = $this->breadcrumbs;
        foreach ($breadcrumbs as $item) {
            $path = array_merge(array($item['name']), $path);
        }

        $title = implode(' | ', array_merge($path, array(Yii::app()->name)));

        return $title;
    }

    public function getMainMenu()
    {
        $data = array();

        // data[] = array('id' => 'members', 'name' => 'Сотрудники', 'url' => $this->createUrl('member/index'));

        return $data;
    }


    public function loadModel($modelName, $paramName = null, $id = null)
    {
        if (!$id) {
            if (isset($paramName) && isset($_GET[$paramName])) {
                $id = $_GET[$paramName];
            } else if (isset($_GET['modelId'])) {
                $id = $_GET['modelId'];
            }
        }
        if ($id) {
            $criteria = new CDbCriteria();
            $criteria->addColumnCondition(array('id' => $id));

            /*if ($modelName == 'User') {
                $criteria->addColumnCondition(array('is_blocked' => 0, 'is_confirmed' => 1));
            }*/

            $model = CActiveRecord::model($modelName)->find($criteria);
        }
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function blockJquery(){
        if( Yii::app()->request->isAjaxRequest ) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery-2.0.0.js'] = false;
            Yii::app()->clientScript->scriptMap['anything.js'] = false;
        }
    }

    /**
     * По массиву из любой модели будет формировать список из ошибок для jGrowl
     * @param $errors
     */
    public function drawError($errors){
        $result = '';
        foreach($errors as $field){
            foreach($field as $error){
                $result.=$error."<br/>";
            }
        }
        return $result;
    }
}