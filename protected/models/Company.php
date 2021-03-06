<?php

/**
 * This is the model class for table "Company".
 *
 * The followings are the available columns in table 'Company':
 * @property string $id
 * @property string $name
 * @property string $address
 * @property string $description
 * @property string $zip
 * @property string $city
 * @property string $phone
 * @property string $mobile_phone
 * @property string $fax
 * @property string $email
 * @property string $site
 * @property string $no_expiration
 * @property integer $country_id
 * @property string $url
 * @property integer $booking_deadline
 * @property integer $booking_interval
 * @property integer $enable_mail_notice
 * @property string $mail_notice_address
 * @property integer $enable_sms_notice
 * @property string $sms_notice_phone
 * @property string $hello_text
 * @property integer $select_timetable
 *
 * The followings are the available model relations:
 * @property Country $country
 * @property CompanyField[] $companyFields
 * @property Question[] $questions
 * @property User[] $users
 */
class Company extends CActiveRecord
{
    public $logo=0;
    public $dayLeft=0;
    public $no_logo=0;
    static $PATH_LOGO='data/';

    public static function getBookingDeadline(){
        return array(
            '1' => '1 ' . Yii::t('main', 'час'),
            '2' => '2 ' . Yii::t('main', 'часа'),
            '5' => '5 ' . Yii::t('main', 'часов'),
            '10' => '10 ' . Yii::t('main', 'часов'),
            '24' => '1 ' . Yii::t('main', 'сутки'),
        );
    }

    public static function getBookingInterval(){
        return array(
            '1' => '1 ' . Yii::t('main', 'месяц'),
            '2' => '2 ' . Yii::t('main', 'месяца'),
            '3' => '3 ' . Yii::t('main', 'месяца'),
            '6' => '6 ' . Yii::t('main', 'месяцев'),
            '12' => '1 ' . Yii::t('main', 'год'),
        );
    }

    public $license;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Company the static model class
     */
    public static function model($className = __CLASS__)
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
            array('logo', 'file','allowEmpty'=>true, 'types' => 'png,jpg,gif', 'maxSize'=>1024 * 1024 * 2, 'tooLarge'=> Yii::t('main', 'Размер файла слишком велик, он не должен превышать 2MB')),
            array('country_id', 'required'),
            array('bic, iban, address, city, name, email, zip', 'required', 'on' => 'distance'),
            array('phone_code, country_id,language_id, booking_deadline, booking_interval, enable_mail_notice, enable_sms_notice, select_timetable,no_logo, enable_confirm', 'numerical', 'integerOnly' => true),
            array('name, address, city, site, url, mail_notice_address', 'length', 'max' => 255),
            array('phone, mobile_phone, fax, sms_notice_phone', 'length', 'max' => 20),
            array('email', 'length', 'max' => 100),
            array('description, zip, hello_text', 'safe'),

            array('zip,name,address,city', 'required','on'=>'signup'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, address, description, zip, city, phone, mobile_phone, fax, email, site, country_id, url, booking_deadline, booking_interval, enable_mail_notice, mail_notice_address, enable_sms_notice, sms_notice_phone, hello_text, select_timetable', 'safe', 'on' => 'search'),
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
            'company2Licenses' => array(self::HAS_MANY, 'Company2License', 'company_id','order'=>'date DESC'),
            'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
            'lang' => array(self::BELONGS_TO, 'Language', 'language_id'),
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
            'zip' => Yii::t('main','Индекс'),
            'city' => Yii::t('main','Город'),
            'phone' => Yii::t('main','Телефон стационарный'),
            'mobile_phone' => Yii::t('main','Телефон мобильный'),
            'fax' => Yii::t('main','Факс'),
            'email' => 'E-mail',
            'site' => Yii::t('main', 'Адрес сайта'),
            'country_id' => Yii::t('main', 'Выбор страны'),
            'url' => Yii::t('main', 'Адрес в интернете www.domain.ru/'),
            'booking_deadline' => Yii::t('main', 'Крайний срок подачи заявок за'),
            'booking_interval' => Yii::t('main', 'Доступный интервал бронирования'),
            'enable_mail_notice' => Yii::t('main', 'Уведомления по электронной почте'),
            'enable_confirm' => Yii::t('main', 'Предварительное подтверждение события'),
            'mail_notice_address' => Yii::t('main', 'Адрес электронной почты'),
            'enable_sms_notice' => Yii::t('main', 'Уведомления через СМС'),
            'sms_notice_phone' => Yii::t('main', 'Номер мобильного телефона'),
            'hello_text' => Yii::t('main', 'Текст приветствия'),
            'select_timetable' => Yii::t('main', 'Выбор сроков для назначения бронирования'),
            'no_expiration' => Yii::t('main', 'Бесконечный лимит'),
            'phone_code' => Yii::t('main', 'Код телефона'),
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

        $criteria = new CDbCriteria;
        $criteria->with = array( 'company2Licenses' );
        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('zip', $this->zip, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('mobile_phone', $this->mobile_phone, true);
        $criteria->compare('fax', $this->fax, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('site', $this->site, true);
        $criteria->compare('country_id', $this->country_id);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('booking_deadline', $this->booking_deadline);
        $criteria->compare('booking_interval', $this->booking_interval);
        $criteria->compare('enable_mail_notice', $this->enable_mail_notice);
        $criteria->compare('mail_notice_address', $this->mail_notice_address, true);
        $criteria->compare('enable_sms_notice', $this->enable_sms_notice);
        $criteria->compare('sms_notice_phone', $this->sms_notice_phone, true);
        $criteria->compare('hello_text', $this->hello_text, true);
        $criteria->compare('select_timetable', $this->select_timetable);

        $criteria->compare( 'company2Licenses.id', $this->license, true );
        return new CActiveDataProvider($this, array(
            'pagination'=>array(
                'pageSize'=>50,
            ),
            'criteria' => $criteria,
        ));
    }

    public function getHash(){
        return md5($this->create_date);
    }
    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            if($this->isNewRecord)
            {
                $this->create_date = Help::currentDate();
                $paymentDate = new DateTime($this->create_date);
                $paymentDate->add(new DateInterval("P".Company2License::addedDay."D"));
                $this->payment_date = $paymentDate->format(Help::DATETIME);
            }
            return true;
        }
        else
            return false;
    }
    protected function afterSave()
    {

        parent::afterSave();
        if($this->isNewRecord){
            $license = new Company2License;
            $license->attributes = array('license_id'=>License::DEFAULT_LICENSE_ID,'company_id'=>$this->id,'is_agree'=>1,'date'=>Help::currentDate());
            $license->save();

            CompanyField::firstField($this->id);
        }
        if($this->no_logo==1){
            if(file_exists($this->getLogoPath())){
                unlink($this->getLogoPath());
            }
        }

        $this->logo=CUploadedFile::getInstance($this,'logo');
        if(!is_null($this->logo)){
            if(!file_exists(self::$PATH_LOGO)){
                mkdir(self::$PATH_LOGO);
            }
            $this->logo->saveAs($this->getLogoPath());
            /*$imageMagic = Yii::app()->image->load( $this->logo->tempName);
            $imageMagic->save(self::$PATH_LOGO.$this->id.".png");*/
        }//попробуем удалить лого


    }
    public function getLogoPath(){
        return $this->getBasePath()."/logo/".$this->id.'.png';
    }
    public function getPreviewPath(){
        return $this->getBasePath()."/preview/".$this->id.'.png';
    }
    public function getBasePath(){
        return self::$PATH_LOGO.$this->id;
    }

    /**
     * Метод вернет язык компании или же по умолчанию
     */
    public function getLanguage(){
        return is_null($this->lang->prefix) ? Language::$DEFAULT : $this->lang->prefix;
    }

    public function drawLogo(){
        $result = '';
        if(file_exists($this->getLogoPath())){
            $result = ''.CHtml::image('/'.$this->getLogoPath()."?img=".rand(1,99999)).
           "<div id='erase-image'>X</div>";
        }
        echo $result;
    }

    public function createFileStructure(){
        Help::make_path('data/'.$this->id."/logo/");
        Help::make_path('data/'.$this->id."/preview/");
    }
    /**
     * метод вернет статус у компании, о том тестовый у нее период или нет
     * @return bool
     */
    public function isTestPeriod(){
        $date = new DateTime($this->create_date);
        $date->add(new DateInterval('P'.Company2License::addedDay.'D'));
        return $this->payment_date ==  $date->format(Help::DATETIME);
    }

    /**
     * Вернет данные о том просрочен последний платеж или нет
     */
    public function isExpiredPayed(){
        return ($this->payment_date < Help::currentDate() && $this->no_expiration==0);
    }
    public function issetLogo(){
       return file_exists($this->getLogoPath());
    }
    public static function isBlock()
    {
        $company = Company::model()->findByPk(Yii::app()->user->companyId);
        return $company->is_block;
    }


}