<?php

/**
 * This is the model class for table "Schedule".
 *
 * The followings are the available columns in table 'Schedule':
 * @property string $id
 * @property string $user_id
 * @property integer $day
 * @property integer $start_hour
 * @property integer $start_min
 * @property integer $end_hour
 * @property integer $end_min
 * @property integer $enable
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Schedule extends CActiveRecord
{
    public $all_answers = 0;
    static public $dayNames = array("Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье");
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Schedule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Schedule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, day, start_hour, start_min, end_hour, end_min, enable,all_answers', 'required'),
			array('day, start_hour, start_min, end_hour, end_min, enable', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, day, start_hour, start_min, end_hour, end_min, enable', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'day' => 'Day',
			'start_hour' => 'Start Hour',
			'start_min' => 'Start Min',
			'end_hour' => 'End Hour',
			'end_min' => 'End Min',
			'enable' => 'Enable',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('day',$this->day);
		$criteria->compare('start_hour',$this->start_hour);
		$criteria->compare('start_min',$this->start_min);
		$criteria->compare('end_hour',$this->end_hour);
		$criteria->compare('end_min',$this->end_min);
		$criteria->compare('enable',$this->enable);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * По переданной AR модели Request попробует найти рамки в которые укладывается
     * @param $request Request
     */
    static public function isRequest(&$request){
        if ($company = Company::model()->findByPk(Yii::app()->user->companyId)) {
            if ($company->is_block) {
                $request->addError('start_date', Yii::t('main','Возможность создавать/редактировать события заблокирована.'));
                return false;
            }
        }
        if ($request->isNewRecord && !Company2License::enableNewEvent($request->user_id)) {
            $request->addError('start_date', 'Достигнуто максимальное кол-во событий(в месяц) для вашей лицензии.');
            return false;
        }

        $week = Help::getWeekDay($request->start_time); //текущий день недели
        $start = new DateTime($request->start_time);
        $end = new DateTime($request->end_time);
        if ($start >= $end) {
            $request->addError('start_date','Начало должно быть раньше окончания');
            return false;
        }
        #соберем время начала и время конца в удобном виде для нашей системы
        $date = array('start_hour'=>$start->format('H'),'start_min'=>$start->format('i'),'end_hour'=>$end->format('H'),'end_min'=>$end->format('i'));
        $criteria = new CDbCriteria;
        $criteria->addCondition('(start_hour<:start_hour OR (start_hour=:start_hour AND start_min<=:start_min) )AND (end_hour>:end_hour OR (end_hour=:end_hour AND end_min>=:end_min))');
        $criteria->addCondition('user_id = :user_id AND day = :week AND enable = 1');
        $criteria->params = array(':user_id'=>$request->user_id,':week'=>$week)+$date;
        $schedule = Schedule::model()->findAll($criteria);
        if(count($schedule)){#если такое время есть, то теперь вторая часть валидации - попробуем найти такие же уже запланированные события
            $criteria = new CDbCriteria;

            $criteria->addCondition("user_id = :user_id");
            $criteria->addCondition("((start_time > :start AND start_time < :end) OR (end_time > :start AND end_time < :end))");
            $criteria->params += array(':user_id' => $request->user_id, ':start'=>$request->start_time,':end'=>$request->end_time);
            $criteria->addCondition("is_block = 0");
            if(!is_null($request->id)){ //для нового события id еще не существует
                $criteria->addCondition('id != :id');
                $criteria->params += array(':id'=>$request->id);
            }
            $anyRequest = Request::model()->findAll($criteria);
            if(count($anyRequest)){ //есть пересечение с другим событием
                if(!Schedule::intervalIsFree($anyRequest)){
                    $request->addError('start_date', 'Событие накладывается на заблокированный интервал');
                } else {
                    $request->addError('start_date', 'Событие накладывается на уже существующее');
                }
                return false; //если есть еще какие-то события "налазящие" на текущее не дадим сохранять
            } else { //проверка на пареллельное событие
                $user = User::model()->findByPk($request->user_id);
                if (!$user){
                    $request->addError('user_id', 'Undefined user_id');
                    return false;
                }
                $criteria = new CDbCriteria;
                $criteria->addCondition("user_id = :user_id");
                $criteria->addCondition("(start_time = :start AND end_time = :end)");
                $criteria->addCondition("is_block = 0");
                $criteria->params = array(':user_id' => $request->user_id, ':start' => $request->start_time, ':end' => $request->end_time);
                if(!is_null($request->id)){ //для нового события id еще не существует
                    $criteria->addCondition('id != :id');
                    $criteria->params += array(':id'=>$request->id);
                }
                $groupRequestCount = Request::model()->count($criteria);
                $criteria->addCondition('block_interval = 1');
                $blockIntervalCount = Request::model()->count($criteria);
                if ($blockIntervalCount != 0) { //в заблокированном интервале
                    $request->addError('start_date', 'Событие накладывается на заблокированный интервал');
                }
                if ($groupRequestCount != 0) { //есть параллельное событие
                    if (!Company2License::enableGroupEvent()) {
                        $request->addError('start_date', 'Групповые события не доступны для вашей лицензии.');
                        return false;
                    }
                    if ($groupRequestCount < $user->group_size) {
                        return true;
                    } else {
                        $request->addError('start_date', 'Превышен максимальный размер группы: ' . $user->group_size . ' чел.');
                        return false;
                    }
                }
            }
            return true;
        }
        else{
            $request->addError('start_date','На данное время нет времени у специалистов');
            return false;
        }

    }
    public static function intervalIsFree($req)
    {
        foreach ($req as $item) {
            if ($item->block_interval) {
                return false;
            }
        }
        return true;
    }
}