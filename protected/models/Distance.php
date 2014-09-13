<?php

/**
 * This is the model class for table "Distance".
 *
 * The followings are the available columns in table 'Distance':
 * @property integer $show_privacy
 * @property integer $request_privacy
 * @property string $text_privacy
 * @property integer $show_condition
 * @property string $note_condition
 * @property string $text_condition
 * @property integer $show_term
 * @property integer $request_term
 * @property string $text_term
 * @property string $url_term
 * @property integer $show_reference
 * @property string $text_reference
 * @property integer $show_reference_add
 * @property integer $request_reference_add
 * @property string $text_reference_add
 * @property integer $param_imprint
 * @property string $address_imprint
 * @property string $text_imprint_add
 */
class Distance extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Distance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('show_privacy, request_privacy, show_condition, show_term, request_term, show_reference, show_reference_add, request_reference_add, param_imprint', 'numerical', 'integerOnly'=>true),
			array('url_term,url_imprint', 'length', 'max'=>255),
			array('text_privacy, note_condition, text_condition, text_term, text_reference, text_reference_add, address_imprint, text_imprint_add', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('show_privacy, request_privacy, text_privacy, show_condition, note_condition, text_condition, show_term, request_term, text_term, url_term, show_reference, text_reference, show_reference_add, request_reference_add, text_reference_add, param_imprint, address_imprint, text_imprint_add', 'safe', 'on'=>'search'),
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
			'show_privacy' => Yii::t('main','Показывать заявление о конфиденциальности'),
			'request_privacy' => Yii::t('main','Требовать отметки заявление о конфиденциальности'),
			'text_privacy' => Yii::t('main','Текст заявление о конфиденциальности'),
			'show_condition' => Yii::t('main','Показывать условия'),
			'note_condition' => Yii::t('main','Заметки для условий'),
			'text_condition' => Yii::t('main','Текст условия'),
			'show_term' => Yii::t('main','Показывать ссылку'),
			'request_term' => Yii::t('main','Требовать просмотр ссылки'),
			'text_term' => Yii::t('main','Текст ссылки'),
			'url_term' => "URL",
			'show_reference' => Yii::t('main','Показывать сроки и условия'),
			'text_reference' => Yii::t('main','Текст условий'),
			'show_reference_add' => Yii::t('main','Показывать дополнительные условия'),
			'request_reference_add' => Yii::t('main','Требовать отметки дополнительных условий'),
			'text_reference_add' => Yii::t('main','Текст дополнительных условий'),
			'param_imprint' => Yii::t('main','Выходные данные'),
			'address_imprint' => Yii::t('main','Адрес'),
			'text_imprint_add' => Yii::t('main','Текст выходных данных'),
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

		$criteria->compare('show_privacy',$this->show_privacy);
		$criteria->compare('request_privacy',$this->request_privacy);
		$criteria->compare('text_privacy',$this->text_privacy,true);
		$criteria->compare('show_condition',$this->show_condition);
		$criteria->compare('note_condition',$this->note_condition,true);
		$criteria->compare('text_condition',$this->text_condition,true);
		$criteria->compare('show_term',$this->show_term);
		$criteria->compare('request_term',$this->request_term);
		$criteria->compare('text_term',$this->text_term,true);
		$criteria->compare('url_term',$this->url_term,true);
		$criteria->compare('show_reference',$this->show_reference);
		$criteria->compare('text_reference',$this->text_reference,true);
		$criteria->compare('show_reference_add',$this->show_reference_add);
		$criteria->compare('request_reference_add',$this->request_reference_add);
		$criteria->compare('text_reference_add',$this->text_reference_add,true);
		$criteria->compare('param_imprint',$this->param_imprint);
		$criteria->compare('address_imprint',$this->address_imprint,true);
		$criteria->compare('text_imprint_add',$this->text_imprint_add,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Distance the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getTermLink($name){
        if($this->url_term==''){
            $link = CHtml::link($name,'#term-block',array('class'=>'fancy'));
        }
        else{
            $link = CHtml::link($name,$this->url_term,array('target'=>'_blank'));
        }
        //Help::dump($link);
        return $link;
    }

    public function getImprintLink($name){
        if($this->param_imprint==1){
            $link = CHtml::link($name,$this->url_imprint,array('target'=>'_blank'));
        }
        else{
            $link = CHtml::link($name,'#imprint-block',array('class'=>'fancy'));
        }
        return $link;
    }

    /**
     * метод подскажет, есть ли хотя бы один чекбокс, который должен подтвердить пользователь
     */
    public function isRequired(){
        return $this->request_privacy || $this->request_reference_add || $this->request_term;
    }
    /**
     * Либо вернет новый объект Distance либо уже существующий
     * @param $companyId
     * @return CActiveRecord|Distance
     */
    public static function getDistance($companyId){
        $distance = Distance::model()->findByAttributes(array('company_id'=>$companyId));
        if(is_null($distance)){
            $distance = new Distance();
        }
        return $distance;
    }
}
