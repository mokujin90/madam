<?php
class ReminderCommand extends CConsoleCommand
{
    public function run($args)
    {
        $dateNow = new DateTime();
        $criteria = new CDbCriteria();
        $criteria->addCondition('start_time > "' . $dateNow->format(Help::DATETIME) . '"');
        $criteria->addCondition('alarm_time > 1');
        $model = Request::model()->findAll($criteria);
        $dateStart = clone $dateNow;
        $dateStart->modify('-50000 minutes');
        $dateEnd = clone $dateNow;
        $dateEnd->modify('+50000 minutes');
        foreach ($model as $item) {
            $dateVal = new DateTime($item->start_time);
            $dateVal->modify("- {$item->alarm_time} hours");
            if ($dateStart < $dateVal && $dateVal < $dateEnd) {
                $license = Company2License::getCurrentLicense($item->user->company_id);
                if ($license->license->email_reminder) {
                    Help::sendMail($item->getEmailField(), 'Напоминание о termin', 'reminder', $item);
                    $item->alarm_time = -1;
                    $item->save(false);
                    echo 'success';
                }
            }
        }
    }
}

