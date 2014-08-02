<?php

/**
 * This is the model class for table "License".
 *
 * The followings are the available columns in table 'License':
 * @property string $id
 * @property string $question
 * @property integer $control_dialog
 * @property integer $group_event
 * @property integer $email_confirm
 * @property integer $sms_confirm
 * @property integer $email_reminder
 * @property integer $sms_reminder
 * @property integer $multilanguage
 * @property integer $event_confirm
 * @property integer $email_event
 * @property integer $sms_event
 * @property integer $caldav
 * @property integer $email_help
 * @property integer $phone_help
 * @property string $employee
 * @property string $max_employee
 * @property string $event
 * @property string $sms
 * @property integer $base_lvl
 * @property integer $is_system
 * @property string $request_text
 *
 * The followings are the available model relations:
 * @property Company2License[] $company2Licenses
 */
class License extends CActiveRecord
{
    const DEFAULT_LICENSE_ID = 1;
    static $base = array('1'=>1,'2'=>2,'3'=>3,'0'=>0);
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'License';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('base_lvl', 'numerical', 'integerOnly'=>true),
			array('question, employee, max_employee, event, sms', 'length', 'max'=>11),
            array('control_dialog, group_event, email_confirm, sms_confirm, email_reminder, sms_reminder, multilanguage, event_confirm, email_event, sms_event, caldav, email_help, phone_help', 'boolean'),
			array('request_text', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, question, control_dialog, group_event, email_confirm, sms_confirm, email_reminder, sms_reminder, multilanguage, event_confirm, email_event, sms_event, caldav, email_help, phone_help, employee, max_employee, event, sms, base_lvl, is_system, request_text', 'safe', 'on'=>'search'),
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
			'company2Licenses' => array(self::HAS_MANY, 'Company2License', 'license_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'question' => 'Question',
			'control_dialog' => 'Control Dialog',
			'group_event' => 'Group Event',
			'email_confirm' => 'Email Confirm',
			'sms_confirm' => 'Sms Confirm',
			'email_reminder' => 'Email Reminder',
			'sms_reminder' => 'Sms Reminder',
			'multilanguage' => 'Multilanguage',
			'event_confirm' => 'Event Confirm',
			'email_event' => 'Email Event',
			'sms_event' => 'Sms Event',
			'caldav' => 'Caldav',
			'email_help' => 'Email Help',
			'phone_help' => 'Phone Help',
			'employee' => 'Employee',
			'max_employee' => 'Max Employee',
			'event' => 'Event',
			'sms' => 'Sms',
			'base_lvl' => 'Base Lvl',
			'is_system' => 'Is System',
			'request_text' => 'Request Text',
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
		$criteria->compare('question',$this->question,true);
		$criteria->compare('control_dialog',$this->control_dialog);
		$criteria->compare('group_event',$this->group_event);
		$criteria->compare('email_confirm',$this->email_confirm);
		$criteria->compare('sms_confirm',$this->sms_confirm);
		$criteria->compare('email_reminder',$this->email_reminder);
		$criteria->compare('sms_reminder',$this->sms_reminder);
		$criteria->compare('multilanguage',$this->multilanguage);
		$criteria->compare('event_confirm',$this->event_confirm);
		$criteria->compare('email_event',$this->email_event);
		$criteria->compare('sms_event',$this->sms_event);
		$criteria->compare('caldav',$this->caldav);
		$criteria->compare('email_help',$this->email_help);
		$criteria->compare('phone_help',$this->phone_help);
		$criteria->compare('employee',$this->employee,true);
		$criteria->compare('max_employee',$this->max_employee,true);
		$criteria->compare('event',$this->event,true);
		$criteria->compare('sms',$this->sms,true);
		$criteria->compare('base_lvl',$this->base_lvl);
		$criteria->compare('is_system',$this->is_system);
		$criteria->compare('request_text',$this->request_text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return License the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function scopes(){
        return array(
            'system'=>array(
                'condition'=>'is_system=1',
            ),

        );
    }

    public function getLicenseType(){
        return $this->is_system==0 ? 0 : $this->base_lvl;
    }

}