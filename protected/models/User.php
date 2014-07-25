<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property string $id
 * @property string $company_id
 * @property string $login
 * @property string $password
 * @property integer $is_owner
 * @property string $name
 * @property string $lastname
 * @property string $description
 * @property integer $calendar_delimit
 * @property integer $calendar_front_delimit
 * @property string $caldav
 * @property array $scheduleUpdate
 *
 * The followings are the available model relations:
 * @property Schedule[] $schedules
 * @property Company $company
 */
class User extends CActiveRecord
{
    public $scheduleUpdate;

    static $calendarDelimit = array(
        '10' => '10 минут',
        '15' => '15 минут',
        '20' => '20 минут',
        '30' => '30 минут',
        '60' => '60 минут',
        '0' => 'Индивидуально',
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'User';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, login, password', 'required'),
			array('is_owner, calendar_delimit, calendar_front_delimit', 'numerical', 'integerOnly'=>true),
			array('company_id', 'length', 'max'=>11),
			array('login, password, name, lastname, description, caldav', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, login, password, is_owner, name, lastname, description, calendar_delimit, calendar_front_delimit, caldav', 'safe', 'on'=>'search'),
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
			'schedules' => array(self::HAS_MANY, 'Schedule', 'user_id'),
			'schedulesOrder' => array(self::HAS_MANY, 'Schedule', 'user_id', 'order' => 'day, start_hour, start_min'),
            'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'company_id' => 'Company',
			'login' => Yii::t('main','Эл. почта'),
			'password' => Yii::t('main','Пароль'),
			'is_owner' => 'Is Owner',
			'name' => Yii::t('main','Имя'),
			'lastname' => Yii::t('main','Фамилия'),
			'description' => Yii::t('main','Описание'),
			'calendar_delimit' => Yii::t('main','Интервал приема'),
			'calendar_front_delimit' => Yii::t('main','Интервал назначений'),
			'caldav' => 'CalDav',
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
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('is_owner',$this->is_owner);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('calendar_delimit',$this->calendar_delimit);
		$criteria->compare('calendar_front_delimit',$this->calendar_front_delimit);
		$criteria->compare('caldav',$this->caldav,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function afterConstruct()
    {
        parent::afterConstruct();
        //Заполняет стандартные значения в расписание нового сотрудника (пн-пт с 8 - 17)
        $this->scheduleUpdate = array();
        for ($day = 0; $day < 5; $day++) {
            $this->scheduleUpdate[$day][] = array('startHour' => 8, 'startMin' => 0, 'endHour' => 17, 'endMin' => 0, 'enable' => true);
        }
    }

    protected function beforeValidate()
    {
        if ($this->isNewRecord) {
            $this->company_id = Yii::app()->user->companyId;
        }
        return parent::beforeValidate();
    }

    protected function afterSave()
    {
        parent::afterSave();

        if (isset($this->scheduleUpdate)) {
            Schedule::model()->deleteAllByAttributes(array('user_id' => $this->id));
            foreach ($this->scheduleUpdate as $day => $item) {
                foreach ($item as $data) {
                    $newSchedule = new Schedule();
                    $newSchedule->user_id = $this->id;
                    $newSchedule->day = $day;
                    $newSchedule->start_hour = $data['startHour'];
                    $newSchedule->start_min = $data['startMin'];
                    $newSchedule->end_hour = $data['endHour'];
                    $newSchedule->end_min = $data['endMin'];
                    $newSchedule->enable = isset($data['enable']) ? $data['enable'] : 0;
                    $newSchedule->save();
                }
            }
        }
    }

    /**
     * Существующая модель: Приводит модель к массиву вида: array[день][] = array(params)
     * Новая модель: возвращает scheduleUpdate
     */
    public function getScheduleByDay()
    {
        if ($this->isNewRecord) {
            return $this->scheduleUpdate;
        }
        $result = array();
        foreach ($this->schedulesOrder as $item) {
            $result[$item->day][] = array('startHour' => $item->start_hour, 'startMin' => $item->start_min, 'endHour' => $item->end_hour, 'endMin' => $item->end_min, 'enable' => $item->enable);
        }
        return $result;
    }

    public function getMenuList()
    {
        return User::model()->findAllByAttributes(array('company_id' => Yii::app()->user->companyId, 'is_owner' => '0'));
    }

}