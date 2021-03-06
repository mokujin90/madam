<?php

class CompanyController extends BaseController
{
    public function actionIndex()
    {
        $this->pageCaption=Yii::t('main',"Данные о компании");
        $this->pageIcon = 'terminal';
        $this->mainMenuActiveId="company";
        $id = Yii::app()->user->companyId;
        $model = Company::model()->findByPk($id);
        $language = Language::model()->findAll(array('index'=>'id'));
        $country = Country::model()->findAll(array('index'=>'id'));
        if(isset($_POST['save']) && count($_POST['Company'])){
            $model->attributes = $_POST['Company'];
            $model->save();
            $this->redirect($this->createUrl('company/index')); //редирект на самого себя нужен для того чтобы применились внешне все изменения
        }
        $this->render('index',array('model'=>$model,'country'=>$country,'language'=>$language));
    }

    public function actionSettings()
    {
        $this->pageCaption=Yii::t('main',"Настройки");
        $this->mainMenuActiveId="settings";

        $id = Yii::app()->user->companyId;
        $model = Company::model()->findByPk($id);

        if (isset($_POST['Company'])) {
            $model->attributes = $_POST['Company'];
            $model->save();

        }

        $this->render('settings', array('model' => $model));
    }

    public function actionDistanceInfo()
    {
        $this->pageCaption=Yii::t('main',"Выслать счет");
        $this->mainMenuActiveId="distance";

        $id = Yii::app()->user->companyId;
        $model = Company::model()->findByPk($id);
        $model->scenario = 'distance';

        $this->performAjaxValidation($model);

        if (isset($_POST['Company'])) {
            $model->attributes = $_POST['Company'];
            if ($model->save()) {
                $companyId = Yii::app()->user->companyId;
                $lastLicense = Company2License::getLicenseBycompany($companyId); //последняя запрошенная лицензия пользователя
                $this->redirect(array('acquiring/salesking','companyId'=>$companyId,'licenseId'=>$lastLicense->id));
            }
        }

        $this->render('distanceForm', array('model' => $model));
    }

    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='validate-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDistance(){
        $this->pageCaption=Yii::t('main',"Юр. информация");
        $this->mainMenuActiveId="distance";
        $model = Distance::model()->getDistance(Yii::app()->user->companyId);
        if (isset($_POST['Distance'])) {

            $model->attributes = $_POST['Distance'];
            $model->company_id = Yii::app()->user->companyId;
            $model->save();

        }
        $this->render('/company/distance/index',array('model'=>$model));
    }

    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Company']))
        {
            $model->attributes=$_POST['Company'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    public function actionMore($type=''){

        $this->pageIcon = 'shopping-cart';
        $this->mainMenuActiveId="more";

        $companyId = Yii::app()->user->companyId; //текущий id компании
        $lastLicense = Company2License::getLicenseBycompany($companyId); //последняя запрошенная лицензия пользователя
        $oldLicense = Company2License::getCurrentLicense(); //текущая лицензия пользователя
        $manual = $oldLicense['license']->getLicenseType()!=0 ? new License() : $oldLicense['license']; //новая лицензия на случай индивидуальной
        $newCompany2License = new Company2License;
        $newCompany2License->company_id = $companyId;
        $standardLicense = License::getStandardLicense();
        $company = Company::model()->findByPk($companyId);
        if(isset($_POST) && $type!=''){

            $default = array('sms','employee','manual',1,2,3);
            if(!in_array($type,$default))
                return false;
            if($type == 'manual' && isset($_POST['License'])){
               $newLicense = new License();
               $newLicense->attributes = $_POST['License'];
               if($newLicense->save()){
                   $newCompany2License->license_id = $newLicense->id;
                   Help::sendMail(Yii::app()->params['adminEmail'], Yii::t('main', "Необходимо установить цену на лицензию"), 'setPriceForManual', $company);

               }
            }//если мы повышаем смс или пользователей и текущий тип лицензии не индивидуальный
            elseif(in_array($type,array('sms','employee')) && $oldLicense['license']->getLicenseType()!=0){

                $added = $type=='sms'? 100:1;
                $newCompany2License->attributes = $oldLicense->attributes;
                $newCompany2License->{$type."_upgrade"} = $newCompany2License->{$type."_upgrade"}+$added;
                #если максимальное количество в этой лицензии sms меньше чем исходное + дополнительное выкинем ошибку
                if($oldLicense['license']->{"max_".$type} < $newCompany2License->{$type."_upgrade"} + $oldLicense['license']->{$type}){
                    $this->redirect($this->createUrl('company/more',array('error'=>Yii::t('main','Превышен лимит'))));
                }
            }
            else{
                $newCompany2License->attributes = $oldLicense->attributes;
                $newCompany2License->employee_upgrade=0;
                $newCompany2License->sms_upgrade=0;
                $newCompany2License->license_id = License::$base[$type];
            }
            #если в результате каких либо обновлений мы создали или присвоили license_id, то сохраняем новый элемент
            if($newCompany2License->license_id!=''){
                $newCompany2License->is_agree = $company->isTestPeriod() ? 1 : 0;
                $newCompany2License->save();
            }
            $this->redirect($this->createUrl('employee/create'));
        }
        $lastPhrase = !$oldLicense->getLastDay() ? Yii::t('main','Оплатите для продления.') : Yii::t('main','Осталось')." ".$oldLicense->getLastDay()." ".Help::getNumEnding($oldLicense->getLastDay(),array(Yii::t('main','день'),Yii::t('main','дня'),Yii::t('main','дней')));
        $this->pageCaption=Yii::t('main',"Лицензия");
        $licenseAlert = Yii::t('main',"Действует")." &laquo;".$oldLicense['license']->getName()."&raquo;. ".$lastPhrase;
        $this->render('more',array('lastLicense'=>$lastLicense,'oldLicense'=>$oldLicense,'manual'=>$manual,'companyId'=>$companyId,'standard'=>$standardLicense, 'licenseAlert' => $licenseAlert,'company'=>$company));
    }

    function actionPreview(){
        $model = Company::model()->findByPk(Yii::app()->user->companyId);
        $model->createFileStructure();
        $model->logo=CUploadedFile::getInstance($model,'logo');
        $model->logo->saveAs($model->getPreviewPath());
        echo CHtml::image('/'.$model->getPreviewPath()."?img=".rand(1,99999))."<div id='erase-image'>X</div>";
        Yii::app()->end();
    }
    function actionTest(){


    }
}