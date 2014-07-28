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

    public $skin="wizard";
    public function run(){
        $this->render($this->skin,array('question'=>$this->question,'field'=>$this->field));
    }

    /**
     * В зависимости от типа вопроса выдаст определенный вывод
     * @param $question Question
     */
    public function drawAnswer($question){
        $result='';
        $count=0;
        foreach($question['answers'] as $answer){
            if($question->type=="radio"){
                $result.='<div class="radio"><label>';
                $result.=Chtml::radioButton('answer['.$question->id.']',$count==0 ? true:false,array('value'=>$answer->id));
            }
            elseif($question->type=="check"){
                $result.='<div class="checkbox"><label>';
                $result.=Chtml::checkBox('answer['.$question->id.']['.$answer->id.']',false,array('value'=>$answer->id));
            }
            $result.=$answer->text;
            $result.=$answer->abbr!=''?' ('.$answer->abbr.')' : '';
            $result.=' </label></div>';
            $count++;
        }

        return $result;
    }

    /**
     * @param $field CompanyField
     * @return string
     */
    public function drawField($field){
        $type = array('char'=>'textField','mail'=>'emailField','numerical'=>'numberField');
        $result='';
        $result.=CHtml::label(Yii::t('main',$field->name),'field_'.$field->id.'_label',array('class'=>$field->type!='required' ? 'init control-label':'control-label')).
            CHtml::openTag('div',array('class'=>'controls')).
                CHtml::$type[$field->validator]('field['.$field->id.']','',array('class'=>'form-control','required'=>$field->type=="required" ? true : false)).
            CHtml::closeTag('div');
        return $result;
    }

}