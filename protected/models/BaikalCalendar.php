<?php

/**
 * This is the model class for table "calendars".
 *
 * The followings are the available columns in table 'calendars':
 * @property string $id
 * @property string $principaluri
 * @property string $displayname
 * @property string $uri
 * @property string $ctag
 * @property string $description
 * @property string $calendarorder
 * @property string $calendarcolor
 * @property string $timezone
 * @property string $components
 * @property integer $transparent
 */
class BaikalCalendar extends BaikalActiveRecord
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
		return 'calendars';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('transparent', 'numerical', 'integerOnly'=>true),
			array('principaluri, displayname', 'length', 'max'=>100),
			array('uri', 'length', 'max'=>200),
			array('ctag, calendarorder, calendarcolor', 'length', 'max'=>10),
			array('components', 'length', 'max'=>21),
			array('description, timezone', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, principaluri, displayname, uri, ctag, description, calendarorder, calendarcolor, timezone, components, transparent', 'safe', 'on'=>'search'),
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
			'principaluri' => 'Principaluri',
			'displayname' => 'Displayname',
			'uri' => 'Uri',
			'ctag' => 'Ctag',
			'description' => 'Description',
			'calendarorder' => 'Calendarorder',
			'calendarcolor' => 'Calendarcolor',
			'timezone' => 'Timezone',
			'components' => 'Components',
			'transparent' => 'Transparent',
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
		$criteria->compare('principaluri',$this->principaluri,true);
		$criteria->compare('displayname',$this->displayname,true);
		$criteria->compare('uri',$this->uri,true);
		$criteria->compare('ctag',$this->ctag,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('calendarorder',$this->calendarorder,true);
		$criteria->compare('calendarcolor',$this->calendarcolor,true);
		$criteria->compare('timezone',$this->timezone,true);
		$criteria->compare('components',$this->components,true);
		$criteria->compare('transparent',$this->transparent);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BaikalCalendar the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
