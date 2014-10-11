<?php
class AdminBaseController extends BaseController
{
    public $menu;
    public $breadcrumbs;
    public $layout = '//layouts/column1';

    public function init()
    {
        Yii::app()->setComponent('user', Yii::app()->adminUser);
        if(!$this->user = Root::model()->findByPk(Yii::app()->user->id)){
            Yii::app()->language = 'de';
        } else {
            Yii::app()->language = is_null($this->user->lang) ? 'de' : $this->user->lang->prefix;
        }
    }

    public function filters()
    {
        return array(
            'accessControl - login',
            'init - login, logout',
            //'roleAccessControl - login, logout'
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }


    public function filterInit($filterChain)
    {
        if (!($this->user = Root::model()->findByPk(Yii::app()->user->id))) {
            Yii::app()->user->logout(false);
            Yii::app()->user->loginRequired();
        }

        $filterChain->run();
    }

    public function returnUrl($action = '')
    {
        $return_url = '/admin';
        if (!empty($_SERVER['HTTP_REFERER'])) {
            if (Yii::app()->request->hostInfo . Yii::app()->request->requestUri == $_SERVER['HTTP_REFERER']) {
                if (isset($_POST['return_url'])) {
                    $return_url = $_POST['return_url'];
                }
            } else {
                $return_url = $_SERVER['HTTP_REFERER'];
            }
        } else {
            if ($action) {
                $return_url = $this->createUrl($action);
            }
        }

        return $return_url;
    }

    public function redirectByRole()
    {
        $this->redirect('/admin/Company/');
    }

    public function getPagetitle()
    {
        return Yii::app()->name;
    }

}

?>
