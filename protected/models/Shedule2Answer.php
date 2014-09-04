<?php

/**
 * This is the model class for table "Shedule2Answer".
 *
 * The followings are the available columns in table 'Shedule2Answer':
 * @property string $id
 * @property string $shedule_id
 * @property string $answer_id
 *
 * The followings are the available model relations:
 * @property Answer $answer
 * @property Schedule $shedule
 */
class Shedule2Answer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Shedule2Answer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shedule_id, answer_id', 'required'),
			array('shedule_id, answer_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, shedule_id, answer_id', 'safe', 'on'=>'search'),
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
			'answer' => array(self::BELONGS_TO, 'Answer', 'answer_id'),
			'shedule' => array(self::BELONGS_TO, 'Schedule', 'shedule_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'shedule_id' => 'Shedule',
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
		$criteria->compare('shedule_id',$this->shedule_id,true);
		$criteria->compare('answer_id',$this->answer_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Shedule2Answer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getByShedule(array $sheduleId){
        return Shedule2Answer::model()->findAllByAttributes(array('shedule_id'=>$sheduleId),array('index'=>'id'));
    }

    /**
     * По массиву объектов Shedule2Answer составит древовидную страктуру [answer_id]=>array('id'=>array(...)))
     * @param $cursor Shedule2Answer[]
     */
    public static function getTreeView(array $cursor){
        $tree = array();
        foreach($cursor as $item){
            $tree[$item->answer_id][$item->shedule_id]=$item->attributes;
        }
        return $tree;
    }

    /**
     * По полученным id ответам определим подходящие schedule_id (при этом исключив те Schedule у которых стоит all_answers
     * @param array $answerId
     */
    public static function getScheduleByAnswer(array $answerId,$companyId){
        /*$scheduleTree = array();
        $criteria = new CDbCriteria();
        $criteria->with = array('shedule.user','answer');
        $criteria->addCondition('shedule.all_answers!=1 && shedule.enable = 1 && user.company_id = :company_id');
        $criteria->params = array(':company_id'=>$companyId);
        //найдем все пересечения любого из ответов
        $schedule2answer = Shedule2Answer::model()->findAll($criteria);

        //сформируем дерево, которое отображает обязательные поля для каждого schedule вместе с question_id (которого нет в базе)
        foreach($schedule2answer as $item){
            $scheduleTree[$item->shedule_id][$item['answer']->question_id][]=$item->answer_id;
        }

        //далее проходимся по обязательной части для каждого shedule из $scheduleTree и пытаемся найти в каждом хотя бы один из ответов
        foreach($scheduleTree as $scheduleId=>$question){
            foreach($question as $answersId ){
                //если массив ответов, который нам пришел и массив обязательных ответов не пересекается, удаляем интервал
                if(!array_intersect($answerId,$answersId)){
                    unset($scheduleTree[$scheduleId]);
                    continue 2;
                }
            }
        }
        return array_keys($scheduleTree);*/
        $simple = array();
        $criteria = new CDbCriteria();
        $criteria->addInCondition('t.answer_id',$answerId);
        $criteria->with = array('shedule');
        $criteria->addCondition('shedule.all_answers!=1 && shedule.enable = 1');
        //найдем все пересечения любого из ответов
        $schedule2answer = Shedule2Answer::model()->findAll($criteria);
        foreach ($schedule2answer as $model){
            $simple[$model->shedule_id][]=$model->answer_id;
        }
        //теперь просто пройдемся по курсору и сопоставим по размеру
        foreach($simple as $scheduleId => $answersId){
            if(count($answerId)!=count($answersId)){
                unset($simple[$scheduleId]);
            }
        }
        //далее найдем всех пользовтелей из этой компании, которые решают ВСЕ вопросы (кроме лидера)

        return array_keys($simple);
    }
}
