<?php
class ReminderCommand extends CConsoleCommand
{
    public function run($args)
    {
        /*$confirmTime = new DateTime('now');
        $criteria = new CDbCriteria();
        $criteria->addCondition('payment_date=NULL && date(create_date) = :confirm_date)');
        $criteria->params=array();
        $model = Request::model()->findAll($criteria);
        $dateStart = clone $dateNow;
        $dateStart->modify('-5 minutes');
        $dateEnd = clone $dateNow;
        $dateEnd->modify('+5 minutes');
        foreach ($model as $item) {
            $dateVal = new DateTime($item->start_time);
            $dateVal->modify("- {$item->alarm_time} hours");
            if ($dateStart < $dateVal && $dateVal < $dateEnd) {
                Help::sendMail($item->getEmailField(), 'Напоминание о termin', 'reminder', $item);
                $item->alarm_time = -1;
                $item->save(false);
            }
        }*/
    }
}

