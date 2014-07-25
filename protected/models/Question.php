<?php

/**
 * This is the model class for table "Question".
 *
 * The followings are the available columns in table 'Question':
 * @property string $id
 * @property string $company_id
 * @property string $text
 * @property string $hint
 * @property integer $type
 * @property integer $position

 *
 * The followings are the available model relations:
 * @property Answer[] $answers
 * @property Company $company
 * @property RequestQuestion[] $requestQuestions
 */
class Question extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Question';
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
			array('position', 'numerical', 'integerOnly'=>true),
			array('company_id', 'length', 'max'=>11),
            array('text', 'length', 'max'=>255),
            array('type', 'length', 'max'=>5),
			array('hint', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, company_id, text, hint, type, position', 'safe', 'on'=>'search'),
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
			'answers' => array(self::HAS_MANY, 'Answer', 'question_id','index'=>'id'),
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'requestQuestions' => array(self::HAS_MANY, 'RequestQuestion', 'question_id'),
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
			'text' => 'Text',
			'hint' => 'Hint',
			'type' => 'One Answer',
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
		$criteria->compare('text',$this->text,true);
		$criteria->compare('hint',$this->hint,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Question the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getQuestion($companyId){
        return Question::model()->with('answers')->findAllByAttributes(array('company_id'=>$companyId),array('index'=>'id','order'=>"position"));
    }
}
