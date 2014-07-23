<?php

class RequestFormController extends BaseController
{
    /**
     * Работа с полями работников компании и анкетой с вопросами и ответами
     * @param int $id id компании
     */
    public function actionIndex($id=1){//TODO: брать из url'a
        $questions = Question::getQuestion($id);
        if(isset($_POST)){
            if(count($_POST['question'])){
                $deletedQuestion = array_diff(array_keys($questions),Help::getIndex($_POST['question'],'id'));
                #узнаем какие вопросы надо удалить или же добавить, обновляем все
                foreach($_POST['question'] as $postQuestion){
                    $newQuestion = ($postQuestion['id']>=1) ? $questions[$postQuestion['id']] : new Question();
                    $newQuestion->attributes = $postQuestion;
                    $newQuestion->company_id=$id;
                    $newQuestion->save();
                }
                if(count($deletedQuestion))
                    Question::model()->deleteAllByAttributes(array('id'=>$deletedQuestion));
                $questions = Question::getQuestion($id);
            }
            else{
                Question::model()->deleteAllByAttributes(array('id'=>array_keys($questions)));
            }
        }

        $this->render('index',array('questions'=>$questions));
    }
}