<?php

/**
 * This is the model class for table "RequestQuestion".
 *
 * The followings are the available columns in table 'RequestQuestion':
 * @property string $id
 * @property string $request_id
 * @property string $question_id
 * @property string $answer_id
 *
 * The followings are the available model relations:
 * @property Request $request
 * @property Question $question
 * @property Answer $answer
 */
class RequestQuestion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'RequestQuestion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('request_id, question_id, answer_id', 'required'),
			array('request_id, question_id, answer_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, request_id, question_id, answer_id', 'safe', 'on'=>'search'),
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
			'request' => array(self::BELONGS_TO, 'Request', 'request_id'),
			'question' => array(self::BELONGS_TO, 'Question', 'question_id'),
			'answer' => array(self::BELONGS_TO, 'Answer', 'answer_id'),
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
			'question_id' => 'Question',
			'answer_id' => 'Answer',
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
		$criteria->compare('question_id',$this->question_id,true);
		$criteria->compare('answer_id',$this->answer_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RequestQuestion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Метод по переданному ключу 'answer' массива $_POST создаст нужные записи в БД по ответам пользователя
     * @param $post $_POST['Answer']
     * @param $request_id
     */
    static public function createByPost($post,$request_id){
        if(count($post)<1 || is_null($post))
            return false;
        foreach($post as $questionId=>$answer){
            is_array($answer) ?
                self::multiCreate($answer,array('request_id'=>$request_id,'question_id'=>$questionId)) :
                self::create(array('request_id'=>$request_id,'question_id'=>$questionId,'answer_id'=>$answer));
        }
    }

    /**
     * Воспользуемся yii'ишным методом для массового создания записи
     * @param $answerId массив с id'ишниками ответов
     * @param $params данные с ключами как в AR
     */
    static protected function multiCreate($answersId,$params){
        $insertRow = array();
        $builder=Yii::app()->db->schema->commandBuilder;
        foreach($answersId as $id){
            $insertRow[]=array('request_id'=>$params['request_id'],'question_id'=>$params['question_id'],'answer_id'=>$id);
        }
        $command=$builder->createMultipleInsertCommand('RequestQuestion',$insertRow);
        $command->execute();
    }
    static protected function create($params){
        $new = new RequestQuestion();
        $new->attributes = $params;
        return $new->save();
    }
}
