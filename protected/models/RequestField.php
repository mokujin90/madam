<?php

/**
 * This is the model class for table "RequestField".
 *
 * The followings are the available columns in table 'RequestField':
 * @property string $id
 * @property string $request_id
 * @property string $field_id
 * @property string $value
 *
 * The followings are the available model relations:
 * @property CompanyField $field
 * @property Request $request
 */
class RequestField extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'RequestField';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('request_id, field_id', 'required'),
			array('request_id, field_id', 'length', 'max'=>11),
			array('value', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, request_id, field_id, value', 'safe', 'on'=>'search'),
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
			'field' => array(self::BELONGS_TO, 'CompanyField', 'field_id'),
			'request' => array(self::BELONGS_TO, 'Request', 'request_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'request_id' => 'Request',
			'field_id' => 'Field',
			'value' => 'Value',
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
		$criteria->compare('request_id',$this->request_id,true);
		$criteria->compare('field_id',$this->field_id,true);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RequestField the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Создадим несколько записей с ответами пользователей в полях
     * @param $params
     */
    static public function createByPost($post,$request_id){
        if(is_null($post)) return false;
        $insertRow = array();
        $builder=Yii::app()->db->schema->commandBuilder;
        foreach($post as $fieldId => $value){
            if($value=='')
                continue;
            $insertRow[]=array('request_id'=>$request_id,'field_id'=>$fieldId,'value'=>$value);
        }
        $command=$builder->createMultipleInsertCommand('RequestField',$insertRow);
        $command->execute();
    }
}
