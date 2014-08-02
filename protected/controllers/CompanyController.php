<?php

class CompanyController extends BaseController
{
    public function actionIndex()
    {
        $this->pageCaption="Данные о компании";
        $this->pageIcon = 'terminal';
        $this->mainMenuActiveId="company";

        $id = Yii::app()->user->companyId;
        $model = Company::model()->findByPk($id);
        $country = Country::model()->findAll(array('index'=>'id'));
        if(isset($_POST['save']) && count($_POST['Company'])){
            $model->attributes = $_POST['Company'];
            $model->save();
        }
        $this->render('index',array('model'=>$model,'country'=>$country));
    }

    public function actionSettings()
    {
        $this->pageCaption="Настройки";
        $this->mainMenuActiveId="settings";

        $id = Yii::app()->user->companyId;
        $model = Company::model()->findByPk($id);

        if (isset($_POST['Company'])) {
            $model->attributes = $_POST['Company'];
            $model->save();
        }

        $this->render('settings', array('model' => $model));
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

        $companyId = Yii::app()->user->companyId;
        $oldLicense = Company2License::getLicenseBycompany($companyId);

        $manual = $oldLicense['license']->getLicenseType()!=0 ? new License() : $oldLicense['license'];

        $newCompany2License = new Company2License;
        $newCompany2License->company_id = $companyId;
        if(isset($_POST) && $type!=''){
            $default = array('sms','employee','manual',1,2,3);
            if(!in_array($type,$default))
                return false;
            if($type == 'manual' && isset($_POST['License'])){
               $newLicense = new License();
               $newLicense->attributes = $_POST['License'];
               if($newLicense->save()){
                   $newCompany2License->license_id = $newLicense->id;
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
                $newCompany2License->is_agree = 0;
                $newCompany2License->save();
            }
            $this->redirect($this->createUrl('employee/create'));
        }
        $this->render('more',array('oldLicense'=>$oldLicense,'manual'=>$manual,'companyId'=>$companyId));
    }
}