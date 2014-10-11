<?php
class ReminderCommand extends CConsoleCommand
{
    public function run($args)
    {
        $dateNow = new DateTime();
        $criteria = new CDbCriteria();
        $criteria->addCondition('start_time > "' . $dateNow->format(Help::DATETIME) . '"');
        $criteria->addCondition('alarm_time >= 1');
        $model = Request::model()->findAll($criteria);
        $dateStart = clone $dateNow;
        $dateStart->modify('-20 minutes');
        $dateEnd = clone $dateNow;
        $dateEnd->modify('+20 minutes');
        foreach ($model as $item) {
            $dateVal = new DateTime($item->start_time);
            $dateVal->modify("- {$item->alarm_time} hours");
            if ($dateStart < $dateVal && $dateVal < $dateEnd) {
                $license = Company2License::getCurrentLicense($item->user->company_id);
                Yii::app()->language = Company::model()->findByPk($item->user->company_id)->getLanguage();
                if ($license->license->email_reminder) {
                    Help::sendMail($item->getEmailField(), Yii::t('main','Напоминание о termin'), 'reminder', $item, $this);
                    $item->alarm_time = -1;
                    $item->save(false);
                    echo 'email success';
                }
                if ($license->license->sms_reminder) {
                    $text = Yii::t('main', 'Не забывайте про назначенный termin! Через {hour} {hourText}', array('{hour}' => $item->alarm_time, '{hourText}' => Help::getNumEnding($item->alarm_time, array(Yii::t('main','час'), Yii::t('main','часа'), Yii::t('main','часов')))));
                    Help::sendSms($item->getPhoneField(), $text, $item);
                    $item->alarm_time = -1;
                    $item->save(false);
                    echo 'sms success';
                }
            }
        }
    }
}

