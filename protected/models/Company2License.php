<?php

/**
 * This is the model class for table "Company2License".
 *
 * The followings are the available columns in table 'Company2License':
 * @property string $id
 * @property string $license_id
 * @property string $company_id
 * @property integer $is_agree
 * @property string $date
 * @property integer $employee_upgrade
 * @property integer $sms_upgrade
 *
 * The followings are the available model relations:
 * @property Company $company
 * @property License $license
 */
class Company2License extends CActiveRecord
{
    const addedDay=30;
    public $name;
    public $type;
    public $companyId;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Company2License';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('license_id, company_id', 'required'),
			array('is_agree, employee_upgrade, sms_upgrade', 'numerical', 'integerOnly'=>true),
			array('license_id, company_id', 'length', 'max'=>11),
			array('date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, license_id, company_id, is_agree, date, employee_upgrade, sms_upgrade,name,type,companyId', 'safe', 'on'=>'search'),
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
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'license' => array(self::BELONGS_TO, 'License', 'license_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'license_id' => 'License',
			'company_id' => 'Company',
			'is_agree' => 'Is Agree',
			'date' => 'Date',
			'employee_upgrade' => 'Employee Upgrade',
			'sms_upgrade' => 'Sms Upgrade',
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
        $criteria->with = array( 'company' );
        $criteria->with = array( 'license' );
		$criteria->compare('id',$this->id,true);
		$criteria->compare('license_id',$this->license_id,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('is_agree',$this->is_agree);
		$criteria->compare('t.date',$this->date,true);
		$criteria->compare('employee_upgrade',$this->employee_upgrade);
		$criteria->compare('sms_upgrade',$this->sms_upgrade);
        $criteria->compare( 'company.name', $this->name, true );
        $criteria->compare( 'license.type', $this->type, true );
        $criteria->compare( 'company.id', $this->companyId, true );
        $criteria->mergeWith(Company2License::getNotApproved());
		return new CActiveDataProvider($this, array(
            'pagination'=>array(
                'pageSize'=>50,
            ),
			'criteria'=>$criteria,

		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Company2License the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function beforeValidate()
    {
       $this->date = Help::currentDate();
        return parent::beforeValidate();
    }
    /**
     * Вернет последнюю лицензию прикрепленную к компании вместе с моделью лицензии по её id
     */
    static public function getLicenseById($id){
        return Company2License::model()->with('license')->findByAttributes(array('id'=>$id),array('order'=>'date DESC'));
    }

    static public function getCurrentLicense($id = null){
        $companyId = $id ? $id : Yii::app()->user->companyId;
        return Company2License::model()->with('license')->findByAttributes(array('company_id'=>$companyId, 'is_agree' => 1),array('order'=>'date DESC'));
    }
    /**
     * Метод, добавляющий еще некоторое количество дней к дате следующего платежа. Т.е. метод продляет на $day дней
     * возможности пользователя на сайте. Ну а если $company->payment_date is null, то увеличиваем сегодняшнюю дату
     * Плюс, разблокирует компанию и выставит данной лицензии is_agree равное 1
     * @param $companyId
     */
    public function doPayment($day=self::addedDay){
        $company = Company::model()->findByAttributes(array('id'=>$this->company_id));
        $newPaymentDate = new DateTime($company->isExpiredPayed() ? 'now' : $company->payment_date);
        $newPaymentDate->add(new DateInterval("P{$day}D"));

        $company->payment_date = $newPaymentDate->format(Help::DATETIME);
        $company->is_block = 0;
        $company->save();

        $this->is_agree=1;
        return $this;//необходимо, чтобы в коде данные применились
    }
    /**
     * @param $companyId
     * @return Company2License
     */
    static public function getLicenseBycompany($companyId){
        return Company2License::model()->with('license')->findByAttributes(array('company_id'=>$companyId),array('order'=>'date DESC'));
    }
    static public function getNotApproved(){
        $criteria = new CDbCriteria;
        $criteria->join = 'JOIN (SELECT company_id, MAX(date) date FROM Company2License GROUP BY company_id) t2 ON t.company_id = t2.company_id AND t.date = t2.date';
        $criteria->with=array('company','license');
        $criteria->condition = 't.is_agree=0';
        return $criteria;
    }

    /**
     * @return bool - возможно ли добавить нового работника
     */
    static public function enableNewEmployee(){
        $companyId = Yii::app()->user->companyId;
        $license = Company2License::getCurrentLicense();
        $ebableEmployeeCount = $license->license->employee + $license->employee_upgrade;
        $employeeCount = User::model()->countByAttributes(array('company_id' => $companyId, 'is_owner' => 0));
        return $employeeCount < $ebableEmployeeCount;
    }

    /**
     * @return mixed - возможно ли исп групповые события
     */
    static public function enableGroupEvent($user_id = false)
    {
        if (Yii::app()->user->companyId) {
            return Company2License::getCurrentLicense()->license->event;
        } elseif ($user_id) {
            return Company2License::getCurrentLicense(User::model()->findByPk($user_id)->company_id)->license->event;
        }
        return false;
    }

    /**
     * @return mixed - возможно ли исп емейл уведомлений
     */
    static public function enableMailNotice(){
        return Company2License::getCurrentLicense()->license->email_event;
    }

    static public function enableMailConfirm(){
        return Company2License::getCurrentLicense()->license->email_confirm || Company2License::getCurrentLicense()->license->sms_confirm;
    }

    /**
     * @return mixed - возможно ли исп емейл уведомлений
     */
    static public function enableSmsNotice(){
        return Company2License::getCurrentLicense()->license->sms_event;
    }

    /**
     * @return bool - возможно ли добавить новое событие в течение месяца
     */
    static public function enableNewEvent($user_id)
    {
        $today = new DateTime();
        $start = new DateTime($today->format('Y-m-01 00:00:00'));
        $end = clone $start;
        $end->modify('+ 1 month');

        if(Yii::app()->user->companyId) {
            $enableEventCount = Company2License::getCurrentLicense()->license->event;
        } else {
            $enableEventCount = Company2License::getCurrentLicense(User::model()->findByPk($user_id)->company_id)->license->event;
        }

        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user_id' => $user_id));
        $criteria->addBetweenCondition('create_date', $start->format(Help::DATETIME), $end->format(Help::DATETIME));

        $eventCount = Request::model()->count($criteria);

        return $eventCount < $enableEventCount;
    }

    /**
     * @return mixed - доступна ли опция компании
     */
    static public function enableOption($option){
        return Company2License::getCurrentLicense()->license[$option];
    }

    /**
     * Попробует посчитать сколько осталось дней с начала активации лицензии, если это не базовая
     */
    public function getLastDay(){
        $valNow = new DateTime();
        $valEnd = new DateTime($this->company->payment_date);
        if($valEnd <= $valNow){
            return false;
        }
        $different = Help::dateDiff(Help::currentDate(),$this->company->payment_date);
        return $different['days_total'];
    }

    static public function getCommonSmsCount($companyId)
    {
        $license = Company2License::getCurrentLicense($companyId);
        $sms = (int)$license->sms_upgrade + (int)$license->license->sms;
        return $sms;
    }

    static public function getSendSmsCount($companyId)
    {
        return Sms::model()->count(array('condition' => "YEAR(send_date) = YEAR(CURDATE()) AND MONTH(send_date) = MONTH(CURDATE()) AND company_id = $companyId"));
    }

    static public function enableSmsCount($companyId)
    {
        return Company2License::getSendSmsCount($companyId) < Company2License::getCommonSmsCount($companyId);
    }
}
