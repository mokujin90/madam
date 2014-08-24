<?php

/**
 * This is the model class for table "Answer".
 *
 * The followings are the available columns in table 'Answer':
 * @property string $id
 * @property string $question_id
 * @property string $text
 * @property string $hint
 * @property string $abbr
 * @property string $icon
 * @property integer $min
 *
 * The followings are the available model relations:
 * @property Question $question
 * @property RequestQuestion[] $requestQuestions
 */
class Answer extends CActiveRecord
{
    static $icon = array('icon-camera-retro'=>'icon-camera-retro','icon-cloud-upload'=>'icon-cloud-upload','icon-coffee'=>'icon-coffee');
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Answer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question_id', 'required'),
			array('min', 'numerical', 'integerOnly'=>true),
			array('question_id', 'length', 'max'=>10),
			array('text, icon', 'length', 'max'=>255),
			array('abbr', 'length', 'max'=>50),
			array('hint', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, question_id, text, hint, abbr, icon, min', 'safe', 'on'=>'search'),
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
			'question' => array(self::BELONGS_TO, 'Question', 'question_id'),
			'requestQuestions' => array(self::HAS_MANY, 'RequestQuestion', 'answer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'question_id' => 'Question',
			'text' => 'Text',
			'hint' => 'Hint',
			'abbr' => 'Abbr',
			'icon' => 'Icon',
			'min' => 'Min',
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
		$criteria->compare('question_id',$this->question_id,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('hint',$this->hint,true);
		$criteria->compare('abbr',$this->abbr,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('min',$this->min);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Answer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Вернет сумму по переданному курсору Answer
     * @param $cursor Answer[]
     */
    public static function getTime(array $cursor){
        $time = 0;
        foreach($cursor as $answer){
            $time += $answer['min'];
        }
        return $time;
    }
}
