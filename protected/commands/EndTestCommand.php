<?php
/**
 * Комманда, которая с периодичностью в один день будет следить за тем, существуют ли компании у которых тестовый период
 * закончится через неделю (это те компании, которые зарегестрировались 23 дня назад)
 * По каждой такой компании отправим письмо администратору портала с просьбой связатья с компанией
 * Class ReminderCommand
 */
class EndTestCommand extends CConsoleCommand
{
    public function run($args)
    {
        //сегодня-23 дня == дата создания
        $confirmTime = new DateTime('now');
        $confirmTime->modify('-23 days');
        $criteria = new CDbCriteria();
        $criteria->addCondition('date(create_date) = :confirm_date');
        $criteria->params=array(':confirm_date'=>$confirmTime->format("Y-m-d")." 00:00:00");
        $companies = Company::model()->with('country')->findAll($criteria);
        foreach($companies as $model){
            if(!$model->isTestPeriod())
                continue; //уберем тех пользователей, которые оплатили лицензию в тот же день, что и зарегистрировались
            $model['license'] = Company2License::getCurrentLicense($model->id);
            Help::sendMail(Yii::app()->params['adminEmail'], Yii::t('main', "У компании истекает тестовый срок"), 'endTest', $model);
        }
    }
}

