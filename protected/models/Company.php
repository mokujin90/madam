<?php

/**
 * This is the model class for table "Company".
 *
 * The followings are the available columns in table 'Company':
 * @property string $id
 * @property string $name
 * @property integer $address
 * @property string $description
 * @property string $zip
 * @property string $city
 * @property string $phone
 * @property string $mobile_phone
 * @property string $fax
 * @property string $email
 * @property string $site
 * @property integer $country_id
 *
 * The followings are the available model relations:
 * @property Country $country
 * @property CompanyField[] $companyFields
 * @property Question[] $questions
 * @property User[] $users
 */
class Company extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Company the static model class
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
		return 'Company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('country_id', 'required'),
            array('country_id', 'numerical', 'integerOnly'=>true),
            array('name,address, city, site', 'length', 'max'=>255),
            array('phone, mobile_phone, fax', 'length', 'max'=>20),
            array('email', 'length', 'max'=>100),
            array('description, zip', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, address, description, zip, city, phone, mobile_phone, fax, email, site, country_id', 'safe', 'on'=>'search'),
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
            'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'companyFields' => array(self::HAS_MANY, 'CompanyField', 'company_id'),
			'questions' => array(self::HAS_MANY, 'Question', 'company_id'),
			'users' => array(self::HAS_MANY, 'User', 'company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
        return array(
            'id' => 'ID',
            'name' => Yii::t('main','Название'),
            'address' => Yii::t('main','Адрес'),
            'description' => Yii::t('main','Описание фирмы'),
            'zip' => Yii::t('main','Инлекс'),
            'city' => Yii::t('main','Город'),
            'phone' => Yii::t('main','Телефон стационарный'),
            'mobile_phone' => Yii::t('main','Телефон мобильный'),
            'fax' => Yii::t('main','Факс'),
            'email' => 'E-mail',
            'site' => Yii::t('main','Адрес сайта'),
            'country_id' => Yii::t('main','Выбор страны'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}