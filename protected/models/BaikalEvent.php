<?php

/**
 * This is the model class for table "calendarobjects".
 *
 * The followings are the available columns in table 'calendarobjects':
 * @property string $id
 * @property string $calendardata
 * @property string $uri
 * @property string $calendarid
 * @property string $lastmodified
 * @property string $etag
 * @property string $size
 * @property string $componenttype
 * @property string $firstoccurence
 * @property string $lastoccurence
 */
class BaikalEvent extends BaikalActiveRecord
{
    public function getDbConnection()
    {
        return self::getBaikalDbConnection();
    }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'calendarobjects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('calendarid, size', 'required'),
			array('uri', 'length', 'max'=>200),
			array('calendarid', 'length', 'max'=>10),
			array('lastmodified, size, firstoccurence, lastoccurence', 'length', 'max'=>11),
			array('etag', 'length', 'max'=>32),
			array('componenttype', 'length', 'max'=>8),
			array('calendardata', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, calendardata, uri, calendarid, lastmodified, etag, size, componenttype, firstoccurence, lastoccurence', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'calendardata' => 'Calendardata',
			'uri' => 'Uri',
			'calendarid' => 'Calendarid',
			'lastmodified' => 'Lastmodified',
			'etag' => 'Etag',
			'size' => 'Size',
			'componenttype' => 'Componenttype',
			'firstoccurence' => 'Firstoccurence',
			'lastoccurence' => 'Lastoccurence',
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
		$criteria->compare('calendardata',$this->calendardata,true);
		$criteria->compare('uri',$this->uri,true);
		$criteria->compare('calendarid',$this->calendarid,true);
		$criteria->compare('lastmodified',$this->lastmodified,true);
		$criteria->compare('etag',$this->etag,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('componenttype',$this->componenttype,true);
		$criteria->compare('firstoccurence',$this->firstoccurence,true);
		$criteria->compare('lastoccurence',$this->lastoccurence,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BaikalEvent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Обновляет (создает) событие в базу байкала
     */
    public static function updateEvent($requestId)
    {
        if (!Company2License::enableOption('caldav')) {
            return;
        }
        if (!$request = Request::model()->with('requestFields')->findByPk($requestId)) {
            return;
        }
        if(!$calendar = BaikalCalendar::model()->findByAttributes(array('principaluri' => 'principals/' . $request->user_id, 'uri' => 'default'))){
            return;
        }
        $now = new DateTime();
        $createDate = new DateTime($request->create_date);
        $startDate = new DateTime($request->start_time);
        $endDate = new DateTime($request->end_time);

        if ($request->baikal_event_id) {
            $event = BaikalEvent::model()->findByPk($request->baikal_event_id);
        }

        $event = isset($event) ? $event : new BaikalEvent();

        $iCal = BaikalEvent::geniCal($request, $createDate, $startDate, $endDate);
        $event->calendardata = $iCal;
        $event->uri = $request->id . "-caldavtermin.ics";
        $event->calendarid = $calendar->id;
        $event->etag = md5($iCal);
        $event->componenttype = "VEVENT";
        $event->lastmodified = (int)$now->format('U');
        $event->firstoccurence = (int)$startDate->format('U');
        $event->lastoccurence = (int)$endDate->format('U');
        $event->size = strlen($iCal);
        if ($event->save()) {
            $calendar->saveCounters(array('ctag' => 1));
            if ($request->baikal_event_id != $event->id) {
                $request->baikal_event_id = $event->id;
                $request->save();
            }
        }
    }

    public static function deleteEvent($event_id, $user_id){
        if(!$calendar = BaikalCalendar::model()->findByAttributes(array('principaluri' => 'principals/' . $user_id))){
            return;
        }
        BaikalEvent::model()->deleteByPk($event_id);
        $calendar->saveCounters(array('ctag' => 1));
    }

    public static function geniCal($request, $createDate, $startDate, $endDate, $withoutWrap = false){
        $required = '';
        $other = '';
        foreach ($request->requestFields as $field) {
            if ($field->field->type != 'required') {
                $other .= "{$field->field->name}: {$field->value}; ";
            } else {
                $required .= "{$field->field->name}: {$field->value}; ";
            }
        }
        if($withoutWrap){
            $iCal =
"BEGIN:VEVENT
DTSTAMP:". Help::formatDateICal($createDate) . "Z
DTSTART;TZID=Europe/Moscow:". Help::formatDateICal($startDate) . "
DTEND;TZID=Europe/Moscow:". Help::formatDateICal($endDate) . "
SUMMARY:$required
DESCRIPTION:$other
CLASS:PUBLIC
UID:" . $request->id . "-caldavtermin
END:VEVENT";
        } else {
            $iCal =
"BEGIN:VCALENDAR
VERSION:2.0
CALSCALE:GREGORIAN
BEGIN:VEVENT
DTSTAMP:". Help::formatDateICal($createDate) . "Z
DTSTART;TZID=Europe/Moscow:". Help::formatDateICal($startDate) . "
DTEND;TZID=Europe/Moscow:". Help::formatDateICal($endDate) . "
SUMMARY:$required
DESCRIPTION:$other
CLASS:PUBLIC
UID:" . $request->id . "-caldavtermin
END:VEVENT
END:VCALENDAR";
        }
        return $iCal;
    }
}
