<?php

/**
 * Class EndNoticeCommand
 * Единый метод для рассылки уведомлений компаниям и пользователям о скором прекращении лицензии (тестовые не включаем)
 */
class EndNoticeCommand extends CConsoleCommand
{
    public function run($args)
    {
        $params = array(
            array('day'=>7,'user'=>'company'),
            array('day'=>3,'user'=>'company'),
            array('day'=>1,'user'=>'admin'),
        );
        //будем по отдельности искать лицензии для каждого из условий
        foreach($params as $notices){
            $criteria = new CDbCriteria();
            $confirmTime = new DateTime('now');
            $left = $notices['day'];
            $confirmTime->modify("-$left days");
            $criteria->addCondition('date(payment_date) = :payment_date AND no_expiration=0');
            $criteria->params=array(':payment_date'=>$confirmTime->format("Y-m-d")." 00:00:00");
            $companies = Company::model()->with('country')->findAll($criteria);
            foreach($companies as $model){
                if($model->isTestPeriod())
                    continue; //TODO:убрать в том случае, если необходимо чтобы распространялось и на тестовые лицензии
                $model['license'] = Company2License::getCurrentLicense($model->id);
                var_dump($notices['day']);
                $model->dayLeft = $notices['day'];
                if($notices['user']=='admin'){
                    $email = Yii::app()->params['adminEmail'];
                    $title = Yii::t('main', "У компании ".$model->name." истекает срок лицензии через ".$left." ".Help::getNumEnding($left,array('день','дня','дней')));
                }
                else{
                    $email = $model->email;
                    $title = Yii::t('main', "У вашей компании истекает срок лицензии через ".$left." ".Help::getNumEnding($left,array('день','дня','дней')));
                }
                if($email=='')
                    continue;//только на email'ы отправляем
                Yii::app()->language = $model->getLanguage();
                Help::sendMail($email,$title , 'endNotice'.$notices['user'], $model,true);
            }
        }







    }
}

