<?php
class BaikalActiveRecord extends CActiveRecord {
    private static $db_baikal = null;

    protected static function getBaikalDbConnection()
    {
        if (self::$db_baikal !== null)
            return self::$db_baikal;
        else
        {
            self::$db_baikal = Yii::app()->db_baikal;
            if (self::$db_baikal instanceof CDbConnection)
            {
                self::$db_baikal->setActive(true);
                return self::$db_baikal;
            }
            else
                throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
        }
    }
}