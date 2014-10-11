<?php
/**
 * Комманда, которая будет выполняться раз в день в надежде найти незаблокированную компанию у которой вышел срок последней оплаты,
 * т.е. $company->payment_date<=now и при этом она еще блокирована. То что найдем будет блокировать и выставлять is_agree=0
 */
class BlockCommand extends CConsoleCommand
{
    public function run($args)
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('payment_date <= :currentDate AND no_expiration==0');
        //$criteria->addCondition('is_block = 0');
        $criteria->addCondition('payment_date <= :currentDate');
        $criteria->params=array(':currentDate'=>Help::currentDate());
        $companies = Company::model()->findAll($criteria);
        foreach($companies as $model){
            $currentLicense = Company2License::getLicenseBycompany($model->id);
            $currentLicense->is_agree=0; //чтобы появился запрос в админе
            $currentLicense->save();
            $model->is_block = 1;
            $model->save();
            $model['license'] = Company2License::getCurrentLicense($model->id);
            Yii::app()->language = $model->getLanguage();
            Help::sendMail(Yii::app()->params['adminEmail'], Yii::t('main', "Компания заблокирована"), 'companyBlock', $model, $this);
        }
    }
}

