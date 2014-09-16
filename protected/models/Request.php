<?php

/**
 * This is the model class for table "Request".
 *
 * The followings are the available columns in table 'Request':
 * @property string $id
 * @property string $user_id
 * @property string $create_date
 * @property string $start_time
 * @property string $end_time
 *
 * The followings are the available model relations:
 * @property RequestField[] $requestFields
 * @property RequestQuestion[] $requestQuestions
 */
class Request extends CActiveRecord
{
    public $field;
    public $request;
    const STATUS_IN_PROGRESS=0;
    const STATUS_DECIDED=1;
    const STATUS_CANCELED=2;
    const REPEAT_TO_COUNT=1;
    const REPEAT_TO_DATE=2;
    static $status = array(self::STATUS_IN_PROGRESS=>"В процессе", self::STATUS_DECIDED=>"Решено", self::STATUS_CANCELED=>'Отменено');
    static $statusClass = array(self::STATUS_IN_PROGRESS=>"text-blue", self::STATUS_DECIDED=>"text-purple", self::STATUS_CANCELED=>'text-red');
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, start_time, end_time,is_confirm', 'required'),
			array('user_id', 'length', 'max'=>10),
			array('create_date,is_block,comment,status,alarm_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, create_date, start_time, end_time', 'safe', 'on'=>'search'),
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
			'requestFields' => array(self::HAS_MANY, 'RequestField', 'request_id','index'=>'field_id'),
			'requestQuestions' => array(self::HAS_MANY, 'RequestQuestion', 'request_id','index'=>'answer_id'),
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
			'create_date' => 'Create Date',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
            'is_block' => 'Is block',
            'comment' => Yii::t('main','Комментарий')
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * Скопируем из текущего $this все связи и прочее в запись $donorRequest
     */
    public function copyRequestRelation($donorRequest){
        if(!is_null($donorRequest)){
            //сохраним поля для этого реквеста
            $requestField = RequestField::model()->findAllByAttributes(array('request_id'=>$this->id));
            foreach($requestField as $copy){
                $donorField = new RequestField();
                $donorField->attributes = $copy->attributes;
                $donorField->request_id = $donorRequest->id;
                $donorField->save();
            }
            //сохраним ответы на вопроы
            $requestQuestion = RequestQuestion::model()->findAllByAttributes(array('request_id'=>$this->id));
            foreach($requestQuestion as $copy){
                $donorQuestion = new RequestQuestion();
                $donorQuestion->attributes = $copy->attributes;
                $donorQuestion->request_id = $donorRequest->id;
                $donorQuestion->save();
            }
        }
    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Request the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function beforeValidate()
    {
        // Если новая запись - присваиваем id автора т timestamp
        if($this->isNewRecord){
            $this->create_date = date(Help::DATETIME);
        }

        #1. Предвалидация того, что в выбранный промежуток у этого человека есть свободное время

        if(Schedule::isRequest($this))
            return parent::beforeValidate();
    }
    protected function afterDelete(){
        parent::afterDelete();
        $this->clearQuestionAndField();
        BaikalEvent::deleteEvent($this->baikal_event_id, $this->user_id);
    }
    protected function afterSave()
    {
        parent::afterSave();
    }
    /**
     * Создадим объект Request после прохождения визарда пользователем
     * @param $params
     */
    static public function create($params){
        $new = new Request();
        $new->attributes = $params;
        if ($new->save()) {
            return $new;
        }
        //Help::dump($new->getErrors());
        return null;
    }

    static public function getRequestWithDate($user_id, $without_blocked = false){
        $result = array();
        $addCriteria = array();
        if($without_blocked){
            $addCriteria = array('is_block' => 0);
        }
        $model = Request::model()->findAllByAttributes(array('user_id' => $user_id) + $addCriteria, array('order' => 'start_time'));
        foreach($model as $item){
            $item->start_time = new DateTime($item->start_time);
            $item->end_time = new DateTime($item->end_time);
            $result[$item->start_time->format(Help::DATETIME)][] = $item;
        }
        return $result;
    }

    /**
     * Метод из текущей модели раздели атрибуты $start_date и $end_date отдельно на три строки, дата, время начала и конца
     */
    public function getDiscreteDate(){
        $start = new DateTime($this->start_time);
        $end = new DateTime($this->end_time);
        return array(
            'start'=>$start->format('H:i'),
            'end'=>$end->format('H:i'),
            'date'=>$start->format('Y-m-d'),
            'date_formatted' => $start->format('d/m/Y'),
            'day' => $start->format('N') - 1
        );
    }

    /**
     * Сгенерирует хеш реквеста по его дате
     */
    public function getHash(){
        return md5($this->create_date);
    }

    public function getLightHash(){
        return md5('termin_' . $this->id);
    }

    public function clearQuestionAndField(){
        RequestField::model()->deleteAllByAttributes(array('request_id'=>$this->id));
        RequestQuestion::model()->deleteAllByAttributes(array('request_id'=>$this->id));
    }

    public function createRepeatEvents ($post) {
        $errorEvents = array();
        if (empty($post['start']) || empty($post['days'])) {
            return $errorEvents;
        }
        $thisStart = new DateTime($this->start_time);
        $thisEnd = new DateTime($this->end_time);
        $start = new DateTime(Help::formatDate($post['start']) . $thisStart->format(' H:i:s'));
        $end = new DateTime(Help::formatDate($post['start']) . $thisEnd->format(' H:i:s'));
        $finalCount = null;
        $finalEnd = null;
        if($post['type'] == self::REPEAT_TO_COUNT) {
            if (empty($post['count'])) {
                return $errorEvents;
            }
            $finalCount = (int)$post['count'];
            if ($finalCount < 1) {
                return $errorEvents;
            }
            $finalCount = $finalCount > 40 ? 40 : $finalCount;
        } elseif($post['type'] == self::REPEAT_TO_DATE) {
            if (empty($post['end'])) {
                return $errorEvents;
            }
            $finalEnd = new DateTime(Help::formatDate($post['end']) . $thisStart->format(' H:i:s'));
            if($finalEnd < $start){
                return $errorEvents;
            }
        }
        $this->repeat_event_id = $this->id;
        $count = 0; // считаем события не включая текущее.
        $successCount = 0;

        do {
            if($start != $thisStart && in_array($start->format('N') - 1, $post['days'])){
                $event = new Request();
                $event->attributes = $this->attributes;
                $event->repeat_event_id = $this->id;
                $event->start_time = $start->format(Help::DATETIME);
                $event->end_time = $end->format(Help::DATETIME);
                $event->baikal_event_id = NULL;
                if($event->save()){
                    $successCount++;
                    $this->copyRequestRelation($event);
                    BaikalEvent::updateEvent($event->id);
                } else {
                    $errorEvents[] = array('start' => $start->format(Help::DATETIME), 'end' => $end->format(Help::DATETIME), 'error' => Help::drawError($event->getErrors()));
                }
                $count++;
            }
            $start->modify('+ 1 day');
            $end->modify('+ 1 day');
        } while ((!empty($finalCount) && $count < $finalCount) || (!empty($finalEnd) && $start <= $finalEnd));

        if ($successCount > 0) {
            $this->repeat_event_id = $this->id;
            $this->save(true);
        }
        if(count($errorEvents)){
            if ($successCount > 0) {
                $errorEvents['total'] = array('error' => 'Создано ' . $successCount . '/' . $count, 'type' => 1);
            } else {
                $errorEvents['total'] = array('error' => 'Невозможно создать серию событий.', 'type' => 2);
            }
        }
        return $errorEvents;
    }

    public function getRepeatData()
    {
        $events = Request::model()->findAllByAttributes(array('repeat_event_id' => $this->repeat_event_id), array('order' => 'start_time'));
        $data = array('count' => count($events), 'start' => null, 'end' => null);
        foreach ($events as $event) {
            if (empty($data['start'])) {
                $data['start'] = $event->start_time;
            }
            $data['end'] = $event->end_time;
        }
        $data['start'] = empty($data['start']) ? new DateTime() : new DateTime($data['start']);
        $data['end'] = empty($data['end']) ? new DateTime() : new DateTime($data['end']);
        return $data;
    }

    public function sendNotification($confirm){
        $license = Company2License::getCurrentLicense($this->user->company_id);
        $company = Company::model()->findByPk($this->user->company_id);
        if(!$license->license->email_event || !$company->enable_mail_notice){
            return false;
        }

        $companyMail = array();
        if (!empty($this->user->company->mail_notice_address)) {
            $companyMail[] = $this->user->company->mail_notice_address;
        }
        $companyMail[] = $this->user->login;
        if ($confirm) {
            Help::sendMail($this->getEmailField(), 'termin подтверждается', 'processed', $this);
            Help::sendMail($companyMail, 'Уведомление о создании termin с подтверждением', 'companyConfirmation', $this);
        } else {
            Help::sendMail($this->getEmailField(), 'Уведомление о создании termin', 'notification', $this);
            Help::sendMail($companyMail, 'Уведомление о создании termin', 'companyNotification', $this);
        }
    }

    public function getEmailField(){
        if($field = RequestField::model()->with('field')->find(array('condition' => "request_id = $this->id AND field.validator ='mail'"))){
            return $field->value;
        }
        return null;
    }

    /**
     * В зависимости от ключей массива будет производить нужные проверки
     * @param $param
     */
    public function checkAccess($param){

        $access=false; //изначально доступа нет
        //ЭТАП 1. Доступ к реквесту имеет только пользоваль на которого оно заведено и директор компании
        if(isset($param['user_id']) && isset($param['company_id'])){
            if($param['user_id']==$this->user_id){
                $access=true;
            }
            else{
                $user = User::model()->findByPk($param['user_id']);
                if(is_null($user))
                    return $access;
                //найдем именно директора выбранного юзера
                $director = User::model()->findByAttributes(array('is_owner'=>1,'company_id'=>$user->company_id));

                if($director->company_id == $param['company_id']){
                    $access=true;
                }
            }
        }

        return $access;
    }
    public function getPhoneField(){
        if($field = RequestField::model()->with('field')->find(array('condition' => "request_id = $this->id AND field.validator ='phone'"))){
            return $field->value;
        }
        return null;
    }
}
