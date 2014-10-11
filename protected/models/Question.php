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
            array('position, next_question', 'numerical', 'integerOnly'=>true),
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
            'next_question' => 'Next Question',
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

    /**
     * Метод по отвеченному id вопросу и id ответа на него определит, какой вопрос отдать следующим
     * Если $answerId равен null, значит нам необходимо найти первый вопрос (а это тот на который либо не ссылается не один другой вопрос)
     * @param $questionId id вопроса на который ответили (средний приоритет)
     * @param $answerId массив с ответами (даже если один, все равно в массиве) (высокий приоритет)
     * @param $companyId
     * @param $not array id вопросов, которые не должны повторятьс
     * @return Question | null (когда вопросов больше не будет)
     */
    public function getNextQuestion($companyId,$questionId = null,array $answerId = array(),$not=null){
        $criteria = new CDbCriteria();
        $not = Help::setArray($not);

        $resultId=null;
        //для того чтобы определить какой вопрос первый - вернем первый по id
        if(is_null($questionId)){
            $criteria->addCondition('company_id = :company_id');
            $criteria->params += array(':company_id' => $companyId);
            $criteria->order='id ASC';
            // сначала попробуем найти элемент на который не ссылается хотя бы один из вопросов
            $allQuestions = $this->find($criteria);
            if($allQuestions){
                $resultId = $allQuestions->id;
            }
        }
        else{
            $criteria = new CDbCriteria();
            //запросим текущий вопрос со всеми ответами, чтобы понять какой вопрос выводить следующий
            $criteria->addCondition('t.id = :id');
            $criteria->params += array(':id' => $questionId);
            $criteria->addNotInCondition('t.id',$not);
            $thisQuestion = $this->with('answers')->find($criteria);
            //ПЕРВАЯ попытка. сначало попробуем понять следующий вопрос по ответам
            $answerNext = Help::decorate($thisQuestion['answers'],'next_question');
            foreach($answerNext as $id => $next){
                if(!in_array($id,$answerId))
                    continue;//если в поступивших ответах нет, пропускаем
                if($next==-1)//если среди полученных ответов есть финишный - пользуемся этим
                    return null;
                elseif($next>0 && !in_array($next,$not)){ //если есть выбранные ответы и не встречается в отмененных
                    $resultId = $next;
                    break;
                }
            }
            if(is_null($resultId)){
                //ВТОРАЯ попытка. Следующий вопрос уже будем смотреть по текущему вопросу, а не по ответам на него
                if($thisQuestion->next_question==-1)
                    return null;//в случае когда вопрос последний
                elseif($thisQuestion->next_question>0 && !in_array($thisQuestion->next_question,$not)){
                    $resultId= $thisQuestion->next_question; //точно известен следующий вопрос
                }
                else{//выходит что следующий вопрос любой
                    $criteria = new CDbCriteria();
                    $criteria->addCondition('company_id = :company_id');
                    $criteria->params += array(':company_id' => $companyId);
                    $criteria->addNotInCondition('t.id',array_merge($not,array($questionId)));
                    $criteria->order='id ASC';
                    $criteria->addCondition('t.id > :last_id');
                    $criteria->params += array(':last_id' => $questionId);
                    // сначала попробуем найти элемент на который не ссылается хотя бы один из вопросов
                    if($allQuestions = $this->find($criteria)){
                        $resultId = $allQuestions->id;
                    } else {
                        return null;
                    }

                }
            }



        }
        return $this->with('answers')->findByPk($resultId);
    }

    /**
     * Метод, который по объекту определит, а есть ли необходимый следующий вопрос
     */
    public function issetNext(){
        return $this->next_question != -1;
    }
    public static function getQuestion($companyId){
        return Question::model()->with('answers')->findAllByAttributes(array('company_id'=>$companyId),array('index'=>'id','order'=>"position"));
    }
}
