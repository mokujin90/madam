<?php
class Find extends CFormModel{
    public $startDate='';
    public $endDate='';
    public $field='';
    public $userId;


    public function rules()
    {
        return array(
            array('field', 'safe'),
            array('startDate,endDate','date','allowEmpty'=>true),
        );
    }
    public function attributeLabels()
    {
        return array(
            'field' => Yii::t('replic','Часть ответа'),
            'startDate' => Yii::t('replic','Дата начала'),
            'endDate' => Yii::t('replic','Дата окончания'),
        );
    }

    public function search(){
        $criteria = new CDbCriteria();
        if($this->field!=''){
            $criteria->with=array('requestFields');
            $criteria->addCondition('requestFields.value LIKE :field');
            $criteria->params += array(':field'=>"%".$this->field."%");
        }
        if($this->startDate!=''){
            $start = new DateTime($this->startDate);
            $criteria->addCondition('t.start_time >= :start');
            $criteria->params += array(':start'=>$start->format('Y-m-d 00:00:00'));
        }
        if($this->endDate!=''){
            $end = new DateTime($this->endDate);
            $criteria->addCondition('t.end_time <= :end');
            $criteria->params += array(':end'=>$end->format('Y-m-d 00:00:00'));
        }
        $criteria->addCondition('t.user_id = :user_id');
        $criteria->params += array(':user_id'=>$this->userId);
        return Request::model()->findAll($criteria);
    }

    /**
     * Выведет в нормальном виде кусок html'a
     * @param $cursor Request[]
     */
    public function render($cursor){
        if(count($cursor)==0)
            return Yii::t('main','Подходящих под ваш запрос событий не найдено');
        $result = '';
        $count=0;
        foreach($cursor as $request){
            $result .= ++$count. ". ".$request->start_time." - ".$request->end_time." ".CHtml::link(Yii::t('main','Подробнее'),array('calendar/event',
                'user_id' => $this->userId,'id' =>$request->id))."<br/>";
        }
        return $result;
    }
}