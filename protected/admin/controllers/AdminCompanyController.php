<?php

class AdminCompanyController extends AdminBaseController{

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->layout='adminLayout';
        return true;
    }

    public function actionIndex()
    {
        $this->mainMenuActiveId = 'company';
        $this->pageCaption = 'Company';

        $dataProvider = new CActiveDataProvider('Company', array(
            'criteria' => array(
                'with' => array('company2Licenses'),
            ),
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
        $this->render('/admin/company',array('dataProvider' => $dataProvider,));
    }

    /**
     * @param $id Company2Lecense id
     */
    public function actionEditLicense($id){
        $company2license = Company2License::getLicenseById($id);
        $model = $company2license['license']->getLicenseType()==0 ? $company2license['license'] : new License(); //чистая форма, по умолчанию
        if(is_null($company2license) || !count($company2license['license'])){
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        if(isset($_POST['save'])){
            $newCompany2License = new Company2License(); //новая запись
            $newCompany2License->company_id = $company2license->company_id;
            $newCompany2License->is_agree=1;
            //если мы сохраняем индивидуальную лицензию
            if(isset($_POST['License']) && $_POST['license_type']==0)
            {
                $newLicense = new License();
                $newLicense->attributes = $_POST['License'];
                if($newLicense->save()){
                    $newCompany2License->license_id = $newLicense->id;
                    $newCompany2License->save();
                }
            }//если добавляем новые поля
            elseif($_POST['license_type']!=0){
                $newCompany2License->license_id = $_POST['license_type'];
                $newCompany2License->employee_upgrade = intval($_POST['added']['employee']);
                $newCompany2License->sms_upgrade = intval($_POST['added']['sms']);
                $newCompany2License->save();
            }
            $this->redirect($_POST['url_referrer']!='' && isset($_POST['url_referrer']) ? $_POST['url_referrer'] : Yii::app()->request->urlReferrer);
        }


        $this->render('/admin/licenseCompanyEdit',array(
            'model'=>$model,
            'current'=>$company2license
        ));
    }

    public function actionApproveList(){
        $this->mainMenuActiveId = 'approve';
        $this->pageCaption = 'Approve';
        $criteria = Company2License::getNotApproved();

        $dataProvider = new CActiveDataProvider('Company2License', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
        $this->render('/admin/approve',array('dataProvider' => $dataProvider,));
    }

    public function actionApprove($id){
        $model = $this->loadModel('Company2License',null,$id);
        $model->is_agree=1;
        $model->save();
        $this->redirect(Yii::app()->request->urlReferrer);

    }
    public function actionChangeBlockStatus($id, $status){
        if($company = Company::model()->findByPk($id)){
            $company->is_block = $status ? 0 : 1;
            $company->save();
        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }

}