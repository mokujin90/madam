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
    public $answered;
    public $password_repeat;
    static $calendarDelimit = array(
        '10' => '10 минут',
        '15' => '15 минут',
        '20' => '20 минут',
        '30' => '30 минут',
        '60' => '60 минут',
        '120' => '2 часа',
        //'0' => 'Индивидуально',
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
            array('login','unique','attributeName'=>'login'),
            array('login', 'email'),
			array('company_id, login, password', 'required'),
			array('is_owner, calendar_delimit, calendar_front_delimit, group_size', 'numerical', 'integerOnly'=>true),
			array('company_id,all_answers', 'length', 'max'=>11),
			array('password', 'length', 'min'=>4),
			array('login, password, name, lastname, description, caldav', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_id, login, password, is_owner, name, lastname, description, calendar_delimit, calendar_front_delimit, caldav,all_answers', 'safe', 'on'=>'search'),
            //регистрация, обновление
            array('password_repeat', 'compare', 'compareAttribute'=>'password', 'on'=>'signup'),
            array('password_repeat', 'required','on'=>'signup'),
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
			'login' => Yii::t('main','Логин'),
			'password' => Yii::t('main','Пароль'),
			'is_owner' => 'Is Owner',
			'name' => Yii::t('main','Имя'),
			'lastname' => Yii::t('main','Фамилия'),
			'description' => Yii::t('main','Описание'),
			'group_size' => Yii::t('main','Кол-во человек на прием'),
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

    public static function getAllAnswerUser($companyId){
        return User::model()->findAllByAttributes(array('company_id'=>$companyId,'all_answers'=>1,'is_owner'=>0),array('index'=>'id'));
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

    public function getName(){
        return $this->name." ".$this->lastname;
    }
    protected function beforeValidate()
    {
        if ($this->isNewRecord && $this->is_owner!=1) {
            $this->company_id = Yii::app()->user->companyId;
        }
        return parent::beforeValidate();
    }

    protected function afterSave()
    {
        parent::afterSave();
        $idShedule = array('old'=>0,'new'=>0);//по той причине, что каждое сохранение - это пересоздание интервалов, будем хранить id старых и новых интервалов
        if ($this->isNewRecord && $this->is_owner != 1) { //create BaikalUser
            $transaction = Yii::app()->db_baikal->beginTransaction();
            try {
                $user = new BaikalUser();
                $user->username = $this->id;
                $user->digesta1 = md5($user->username . ':' . 'BaikalDAV' . ':' . $this->password);
                if ($user->save()) {
                    $calendar = new BaikalCalendar();
                    $calendar->principaluri = "principals/" . $this->id;
                    $calendar->displayname = "Termin Calendar";
                    $calendar->uri = "default";
                    $calendar->ctag = 1;
                    $calendar->description = "Termin Calendar";
                    $calendar->components = "VEVENT,VTODO";
                    if (!$calendar->save()) {
                        throw new CException('Transaction failed');
                    }
                    $principal = new BaikalPrincipal();
                    $principal->id = $user->id;
                    $principal->uri = "principals/" . $this->id;
                    $principal->email = $this->login;
                    $principal->displayname = $this->login;
                    if (!$principal->save()) {
                        throw new CException('Transaction failed');
                    }
                    $adbook = new BaikalAddressbook();
                    $adbook->id = $user->id;
                    $adbook->principaluri = "principals/" . $this->id;
                    $adbook->uri = "default";
                    $adbook->displayname = $this->login;

                    if (!$adbook->save()) {
                        throw new CException('Transaction failed');
                    }
                    $this->updateByPk($this->id, array('baikal_user_id' => $user->id));
                } else {
                    throw new CException('Transaction failed');
                }
                $transaction->commit();
            } catch (Exception $ex) {
                $transaction->rollback();
            }

        } elseif($this->is_owner != 1) { //update BaikalUser pass
            if($user = BaikalUser::model()->findByPk($this->baikal_user_id)){
                $newPass = md5($user->username . ':' . 'BaikalDAV' . ':' . $this->password);
                if ($user->digesta1 != $newPass) {
                    $user->digesta1 = $newPass;
                    $user->save();
                }
            }
        }
        if (isset($this->scheduleUpdate)) {

            //запросим все интервалы, пока не удалили, чтобы
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
                    $newSchedule->all_answers = $data['all_answers'];
                    $newSchedule->save();
                    if(isset($data['schedule2answer']) && count($data['schedule2answer']) && !is_null($newSchedule->id)){
                        foreach($data['schedule2answer'] as $answerId=>$value){
                            $schedule2answer = new Shedule2Answer();
                            $schedule2answer->answer_id =$answerId;
                            $schedule2answer->shedule_id = $newSchedule->id;
                            $schedule2answer->save();
                        }
                    }
                }
            }

        }
        if (isset($this->answered)) {

            $user2answer = User2Answer::model()->findAllByAttributes(array('user_id'=>$this->id),array('index'=>'answer_id')); //пришлось заного запрашивать эти данные
            $deletedAnswer = array_diff(array_keys($user2answer),array_keys($this->answered)); //удаленные ответы
            $addedAnswer = array_diff(array_keys($this->answered),array_keys($user2answer));
            if(count($addedAnswer)){
                foreach ($addedAnswer as $item) {
                    $new = new User2Answer();
                    $new->attributes=array('user_id'=>$this->id,'answer_id'=>$item);
                    $new->save();
                }
            }
            if(count($deletedAnswer)){
                User2Answer::model()->deleteAllByAttributes(array('user_id'=>$this->id,'answer_id'=>$deletedAnswer));
            }
        }
        //Help::dump($this->scheduleUpdate);
    }
    protected function afterDelete(){
        parent::afterDelete();
        if ($this->is_owner != 1) {
            if($calendars = BaikalCalendar::model()->findAllByAttributes(array('principaluri' => 'principals/' . $this->id))){
                foreach($calendars as $calendar){
                    BaikalEvent::model()->deleteAllByAttributes(array('calendarid' => $calendar->id));
                    $calendar->delete();
                }
            }
            BaikalUser::model()->deleteAllByAttributes(array('username' => $this->id));
            BaikalPrincipal::model()->deleteAllByAttributes(array('uri' => 'principals/' . $this->id));
            BaikalAddressbook::model()->deleteAllByAttributes(array('principaluri' => 'principals/' . $this->id));
        }
    }
    /**
     * Существующая модель: Приводит модель к массиву вида: array[день][] = array(params)
     * Новая модель: возвращает scheduleUpdate
     */
    public function getScheduleByDay($withDisable = true, $answerFilter = false, $confirmedSchedule = array())
    {
        if ($this->isNewRecord) {
            return $this->scheduleUpdate;
        }
        $result = array();
        foreach ($this->schedulesOrder as $item) {
            if ($item->enable == 0 && !$withDisable) {
                continue;
            }
            if($answerFilter && !$item->all_answers && !in_array($item->id, $confirmedSchedule)){
                continue;
            }
            $result[$item->day][] = array('startHour' => $item->start_hour, 'startMin' => $item->start_min, 'endHour' => $item->end_hour, 'endMin' => $item->end_min, 'enable' => $item->enable,'id'=>$item->id,'all_answers'=>$item->all_answers);
        }
        return $result;
    }

    /**
     * Из полученного массива из getScheduleByDay вычленим id событий (чтобы снова не запрашивать данные)
     */
    static public function getSheduleId($array){
        $sheduleId = array();
        if(count($array)){
            foreach($array as $item){
                foreach($item as $shedule){
                    $sheduleId[$shedule['id']] = $shedule['id'];
                }
            }
        }
        return $sheduleId;
    }
    static public function getMenuList()
    {
        return User::model()->findAllByAttributes(array('company_id' => Yii::app()->user->companyId, 'is_owner' => '0'));
    }

}