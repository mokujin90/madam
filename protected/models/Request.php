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
			array('user_id, start_time, end_time', 'required'),
			array('user_id', 'length', 'max'=>10),
			array('create_date', 'safe'),
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
        if($this->getIsNewRecord()){
            $this->create_date=new CDbExpression('NOW()');
        }
        #1. Предвалидация того, что в выбранный промежуток у этого человека есть свободное время

        if(Schedule::isRequest($this))
            return parent::beforeValidate();
    }
    protected function afterDelete(){
        parent::afterDelete();
        $this->clearQuestionAndField();
    }
    /**
     * Создадим объект Request после прохождения визарда пользователем
     * @param $params
     */
    static public function create($params){
        $new = new Request();
        $new->attributes = $params;
       $new->save();
        return $new;
    }

    static public function getRequestWithDate($user_id){//TODO: collapse duplicate requests (start/end)
        $result = array();
        $model = Request::model()->findAllByAttributes(array('user_id' => $user_id), array('order' => 'start_time'));
        foreach($model as $item){
            $item->start_time = new DateTime($item->start_time);
            $item->end_time = new DateTime($item->end_time);
            $result[] = $item;
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
            'date_formatted' => $start->format('m/d/Y')
        );
    }

    public function clearQuestionAndField(){
        RequestField::model()->deleteAllByAttributes(array('request_id'=>$this->id));
        RequestQuestion::model()->deleteAllByAttributes(array('request_id'=>$this->id));
    }
}
