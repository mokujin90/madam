<?php

class WizardWidget extends CWidget{
    /**
     * @var $question Question[]
     */
    public $question;

    /**
     * @var $field CompanyField[]
     */
    public $field;
    public $company;

    /**
     * Ответы на вопросы и поля
     * @var Request
     */
    public $request=null;
    public $skin="wizard";
    public $companyId = null;
    /**
     * Параметр от которого зависит как будут выводиться вопросы - по одному (true) или все сразу (false)
     * @var bool
     */
    public $wizardStep=true;

    /**
     * @var bool показывать ли кнопку далее
     */
    public $showAgree=false;
    public function run(){
        if(is_null($this->question[0])){
            echo "Извините, но в базе данных вопросы отсуствуют";
            return false;
        }
        $this->request = $this->request ? $this->request : new Request(); //wizard fix
        $this->render($this->skin,array('question'=>$this->question,'field'=>$this->field,'request'=>$this->request,'companyId'=>$this->companyId,'showAgree'=>$this->showAgree,'company'=>$this->company));
    }

    /**
     * В зависимости от типа вопроса выдаст определенный вывод
     * @param $question Question
     * @param $answerArray array Массив из relation'a модели Request['requestQuestions']
     * @param
     */
    public function drawAnswer($question,$answerArray=array()){
        if(is_null($question)){
            return "Извините, вопросов в базе данных нет";
        }
        $result='';
        $count=0;
        foreach($question['answers'] as $answer){
            if($question->type=="radio"){
                $result.='<div class="radio"><label>';
                $result.=CHtml::radioButton('answer['.$question->id.']',$this->getAnswerRadio($answer->id,$answerArray,$this->request->id,$count),array('value'=>$answer->id));
            }
            elseif($question->type=="check"){
                $result.='<div class="checkbox"><label>';
                $result.=CHtml::checkBox('answer['.$question->id.']['.$answer->id.']',$this->getAnswerCheck($answer->id,$answerArray,$this->request->id,$count),array('value'=>$answer->id));
            }
            $result.=$answer->text;
            $result.=$answer->abbr!=''?' ('.$answer->abbr.')' : '';
            $result.=' </label></div>';
            $count++;
        }

        return $result;
    }

    /**
     * Метод, который сможет оценить что вывести в ответе на вопросы
     * @param $answerId
     * @param $answerArray
     * @param $isNew
     */
    private function getAnswerRadio($answerId,$answerArray,$requestId=null,$count=0){
        //Help::dump(array($answerId,$answerArray,$requestId,$count),false);
        if((empty($answerArray) && $count==0) || isset($answerArray[$answerId])){
            return true;
        }
        else{
            return false;
        }
    }
    private function getAnswerCheck($answerId,$answerArray,$requestId=null,$count=0){
        if(isset($answerArray[$answerId])){
            return true;
        }
        else{
            return false;
        }
    }
    /**
     * @param $field CompanyField
     * @return string
     */
    public function drawField($field,$value=null){
        $type = array('char'=>'textField','mail'=>'emailField','numerical'=>'numberField','name'=>'textField','lastname'=>'textField','firm'=>'textField','phone'=>'numberField');
        $result='';
        $result.=CHtml::label(Yii::t('main',$field->name),'field_'.$field->id.'_label',array('class'=>$field->type!='required' ? 'init control-label':'control-label')).
            CHtml::openTag('div',array('class'=>'controls')).
                CHtml::$type[$field->validator]('field['.$field->id.']',is_null($value) ? '' : $value,array('class'=>'form-control','required'=>$field->type=="required" ? true : false)).
            CHtml::closeTag('div');
        return $result;
    }

    public function getEventDateInterval()
    {
        $company = Company::model()->findByPk($this->companyId);
        $start = new DateTime();
        $start->modify("+ {$company->booking_deadline} hours");
        $end = clone $start;
        $end->modify("+ {$company->booking_interval} months");
        return array('start' => $start->format('Y-m-d'), 'end' => $end->format('Y-m-d'));
    }
}