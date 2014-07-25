<?php

/**
 * This is the model class for table "CompanyField".
 *
 * The followings are the available columns in table 'CompanyField':
 * @property string $id
 * @property string $company_id
 * @property string $name
 * @property string $type
 * @property string $validator
 * @property integer $position
 * @property integer $is_userfield
 *
 * The followings are the available model relations:
 * @property Company $company
 * @property RequestField[] $requestFields
 */
class CompanyField extends CActiveRecord
{
    static $params = array('disabled'=>'Отключить','enabled'=>'Не обзательно', 'required'=>'Обязательно');
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'CompanyField';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id', 'required'),
			array('position,is_userfield', 'numerical', 'integerOnly'=>true),
			array('company_id', 'length', 'max'=>10),
			array('name', 'length', 'max'=>255),
			array('type', 'length', 'max'=>8),
			array('validator', 'length', 'max'=>9),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, company_id,is_userfield, name, type, validator, position', 'safe', 'on'=>'search'),
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
			'requestFields' => array(self::HAS_MANY, 'RequestField', 'field_id'),
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
			'name' => 'Name',
			'type' => 'Type',
			'validator' => 'Validator',
			'position' => 'Position',
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
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('validator',$this->validator,true);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CompanyField the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getFieldByCompany($id){
        return CompanyField::model()->findAllByAttributes(array('company_id'=>$id),array('order'=>'position,is_userfield','index'=>'id'));
    }
}
