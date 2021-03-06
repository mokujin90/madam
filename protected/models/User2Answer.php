<?php

/**
 * This is the model class for table "User2Answer".
 *
 * The followings are the available columns in table 'User2Answer':
 * @property string $id
 * @property string $user_id
 * @property string $answer_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Answer $answer
 */
class User2Answer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'User2Answer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, answer_id', 'required'),
			array('user_id, answer_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, answer_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
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
			'user_id' => 'User',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('answer_id',$this->answer_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    /**
     *Найдем всех пользователей, которые подходят под нужные вопросы
     * @param $answers массив из idэишников ответов
     */
    static public function getNeedUser(array $answers,$companyId){
        $simple = array(); //результирующий массив пользователей
        //сначало попробуем найти именно тех пользователей, которые подходят под все ответы
        //выберем всех пользователей, у которых есть такие ответы в User2Answer, по индексу User_id
        $usersAnswers = User2Answer::model()->findAllByAttributes(array('answer_id'=>$answers));
        foreach ($usersAnswers as $model){
            $simple[$model->user_id][]=$model->answer_id;
        }
        //теперь просто пройдемся по курсору и сопоставим по размеру
        foreach($simple as $userId => $answersId){
           if(count($answers)!=count($answersId)){
               unset($simple[$userId]);
           }
        }

        //далее найдем всех пользовтелей из этой компании, которые решают ВСЕ вопросы (кроме лидера)
        $allAnswerId = User::model()->getAllAnswerUser($companyId);
        return array_merge(array_keys($simple),array_keys($allAnswerId));
    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User2Answer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getAnswerByUser($id){
        return User2Answer::model()->findAllByAttributes(array('user_id'=>$id),array('index'=>'answer_id'));
    }
}
