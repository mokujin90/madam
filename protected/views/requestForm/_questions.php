<div class="col-xs-12 col-sm-8">
    <h4><?=Yii::t('main','Составьте вопросы')?></h4>
    <ul class="nav nav-tabs">
        <?php $count=1;?>
        <?foreach($questions as $id=>$question):?>
            <li data-count="<?=$count?>" class="<?if($count==1):?>active<?endif?>">
                <?=CHtml::link(Yii::t('main','Вопрос').' '.$count,array('RequestFormController/index','#'=>'q'.$count++),array('data-toggle'=>'tab'))?>
            </li>
        <?endforeach;?>
        <button type="button" id="remove-question" class="btn btn-warning pull-right"><?= Yii::t('main','Удалить вопрос')?></button>
        <button type="button" id="add-question" class="btn btn-success pull-right"><?= Yii::t('main','Добавить вопрос')?></button>

    </ul>
    <div id="question-tab" class="tab-content">
        <? $count=0;?>
        <?foreach($questions as $id=>$question):?>
            <div class="tab-pane <?if(++$count==1):?>active<?endif?>" id="q<?=$count?>">
                <?=CHtml::hiddenField("question[".$count."][id]",$id)?>
                <div class="box" style="margin-bottom: 0">
                    <div class="box-header orange-background">
                        <div class="title"><?=Yii::t('main','Вопрос')?></div>
                        <div class="actions">
                            <a class="add-answer btn btn-xs btn-link" href="#"><i class="icon-plus"></i> <?= Yii::t('main','Добавить ответ')?></a>
                            <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-4 control-label"><?=Yii::t('main','Вопрос')?>:</label>
                            <div class="col-xs-10 col-sm-6 col-lg-7">
                                <?=CHtml::textField('question['.$count.'][text]',$question->text,array('class'=>'form-control'));?>
                            </div>
                            <div class="col-xs-2 col-sm-2 col-lg-1">
                                <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-4 control-label"><?=Yii::t('main','Подсказка к вопросу')?>:</label>
                            <div class="col-xs-10 col-sm-6 col-lg-7">
                                <?= CHtml::textArea("question[".$count."][hint]",$question->hint,array('class'=>'form-control','rows'=>3))?>
                            </div>
                            <div class="col-xs-2 col-sm-2 col-lg-1">
                                <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 col-md-4"></label>
                            <div class="col-sm-12 col-md-8">
                                <label class="control-label">
                                    <?=CHtml::radioButton("question[".$count."][type]",$question->type=='radio'?true:false,array('value'=>'radio','id'=>'optionsRadios1'))?>
                                    <?=Yii::t('main','Возможно выбрать только один ответ')?>
                                </label>

                                <label class="control-label">
                                    <?=CHtml::radioButton("question[".$count."][type]",$question->type=='check'?true:false,array('value'=>'check','id'=>'optionsRadios2'))?>
                                    <?=Yii::t('main','Возможно выбрать несколько ответов')?>
                                </label>
                            </div>
                        </div>
                        <div class="answers">
                            <?if(count($question['answers'])):?>
                            <? $countAnswer=0;?>
                            <?foreach($question['answers'] as $answer):?>
                                <div class="answer box" style="margin-bottom: 0" data="<?=$countAnswer?>">
                                    <?=CHtml::hiddenField("question[".$count."][answer][".$countAnswer."][id]",$answer->id);?>
                                    <div class="box-header">
                                        <div class="title"><?=Yii::t('main','Ответ')?></div>
                                        <div class="actions">
                                            <a class="remove-answer btn btn-xs btn-link" href="#"><i class="icon-remove"></i> <?=Yii::t('main','Удалить ответ')?></a>
                                            <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                                        </div>
                                    </div>
                                    <div class="box-content">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-5">
                                                    <label class="col-xs-2 control-label"><?=Yii::t('main','Ответ')?></label>
                                                </div>
                                                <div class="col-xs-2 col-xs-offset-2">
                                                    <label class="control-label"><?=Yii::t('main','Время, мин')?></label>
                                                </div>
                                            </div>

                                            <div class="col-xs-6">
                                                <?=CHtml::textField("question[".$count."][answer][".$countAnswer."][text]",$answer->text,array('class'=>'form-control'))?>
                                            </div>
                                            <div class="col-xs-1">
                                                <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                                            </div>
                                            <div class="col-xs-3">
                                                <div class="">
                                                    MIN
                                                    <?=CHtml::textField("question[".$count."][answer][".$countAnswer."][min]",$answer->min,array('class'=>'form-control'))?>
                                                    ABBR
                                                    <?=CHtml::textField("question[".$count."][answer][".$countAnswer."][abbr]",$answer->abbr,array('class'=>'form-control'))?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <label><?=Yii::t('main','Примечания')?></label>
                                            </div>
                                            <div class="col-xs-6">
                                                <?=CHtml::textArea("question[".$count."][answer][".$countAnswer."][hint]",$answer->hint,array('class'=>"form-control","rows"=>3))?>
                                            </div>
                                            <div class="col-xs-1">
                                                <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                                            </div>
                                            <div class="col-xs-2">
                                                <div class="btn-group dropdown">
                                                    <button class="btn dropdown-toggle" data-toggle="dropdown" style="margin-bottom:5px">
                                                        <i class="<?=$answer->icon?>"></i>
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu answer-icon">
                                                        <?foreach(Answer::$icon as $icon):?>
                                                        <li><a href="#"><i class="<?=$icon?>"></i></a></li>
                                                        <?endforeach;?>
                                                    </ul>
                                                    <?=CHtml::hiddenField("question[".$count."][answer][".$countAnswer."][icon]",$answer->icon,array('class'=>'model-icon'))?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?$countAnswer++;?>
                                <?endforeach;?>
                            <?=CHtml::hiddenField('',$countAnswer,array('class'=>'count-answer'))?>
                            <?endif;?>
                        </div>
                    </div>
                </div>


            </div>
        <?endforeach;?>

        <?=CHtml::hiddenField('',$count,array('id'=>'count-tab'))?>
    </div>
    <div id="button-panel" class="form-group">
        <hr>
        <div class="col-lg-offset-7 col-lg-5">
            <button type="submit" class="btn btn-success pull-right">Сохранить</button>
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-4">
    <h4>Составление вопросов</h4>
                <span>
                    Установив вопросы и соответствующие варианты ответов, вы можете управлять при бронировании назначение,
                    как долго свидетельствует назначения. В интернет-назначения бронирование назначение период назначения
                    Страна Easy автоматически рассчитывается и учитывается в бронировании назначения. Если ввести дату в своем дневнике,
                    так предполагает назначение Страна Легкая основа из ответов, которые вы выбрали, прежде чем соответствующее время назначения.
                    Является более чем на одном вопросе срочного депозита, продолжительность сумме этих времен формируется. Если у вас есть какие-либо вопросы определить,
                    а затем использовать код даты, используемый в онлайн назначения встречу бронирования как длины, что вы установили для графика
                    ( Настройки&gt; вкладка Параметры расписания: Расписание Дополнительная ).
                </span>
</div>