<?php

class RequestFormController extends BaseController
{
    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->pageCaption="Данные об анкете";
        $this->pageIcon = 'book';
        $this->mainMenuActiveId="question";
        return true;
    }

    /**
     * Работа с полями работников компании и анкетой с вопросами и ответами
     * @param int $id id компании
     */
    public function actionIndex(){//TODO: брать из url'a
        $id = Yii::app()->user->companyId;
        $questions = Question::getQuestion($id);
        $fields = CompanyField::model()->getFieldByCompany($id);
        if(isset($_POST['field'])){
            $positionField=0;
            $deletedField = array_diff(array_keys($fields),Help::getIndex($_POST['field'],'id'));
            foreach($_POST['field'] as $postField){
                if($postField['name']=='') continue; #пропустим обработку с пустым вопросом
                $newField = $postField['id']>=0 && isset($fields[$postField['id']]) ? $fields[$postField['id']] : new CompanyField();
                $newField->attributes = $postField;
                if($newField->isNewRecord){
                    $newField->is_userfield = 1;
                    $newField->validator="char";
                }
                $newField->company_id = $id;
                $newField->position = $positionField;
                $newField->save();
                $positionField++;
            }
            if(count($deletedField))
                CompanyField::model()->deleteAllByAttributes(array('id'=>$deletedField));
            if(count($_POST['question'])){
                $deletedQuestion = array_diff(array_keys($questions),Help::getIndex($_POST['question'],'id'));
                #узнаем какие вопросы надо удалить или же добавить, обновляем все
                foreach($_POST['question'] as $postQuestion){
                    $newQuestion = $postQuestion['id']>=1 ? $questions[$postQuestion['id']] : new Question();
                    $newQuestion->attributes = $postQuestion;
                    $newQuestion->company_id=$id;
                    $newQuestion->save();
                    Help::recommend($questions[$newQuestion->id]['answers']); //для дальнейших действий сделаем, что у всех будет как минимум пустой массив
                    $deletedAnswer = array_diff(array_keys($questions[$newQuestion->id]['answers']),Help::getIndex($postQuestion['answer'],'id'));
                    if(count($postQuestion['answer'])){
                        foreach($postQuestion['answer'] as $postAnswer){
                            $newAnswer = $postAnswer['id']>=1 && isset($questions[$newQuestion->id]['answers'][$postAnswer['id']]) ? $questions[$newQuestion->id]['answers'][$postAnswer['id']] : new Answer();
                            $newAnswer->attributes = $postAnswer;
                            $newAnswer->question_id = $newQuestion->id;
                            $newAnswer->save();
                        }
                    }
                    if(count($deletedAnswer))
                        Answer::model()->deleteAllByAttributes(array('id'=>$deletedAnswer));
                }
                if(count($deletedQuestion))
                    Question::model()->deleteAllByAttributes(array('id'=>$deletedQuestion));
                $questions = Question::getQuestion($id);
            }
            else{
                //Question::model()->deleteAllByAttributes(array('id'=>array_keys($questions)));
            }
            $fields = CompanyField::model()->getFieldByCompany($id);
        }

        $this->render('index',array('questions'=>$questions,'fields'=>$fields));
    }
}