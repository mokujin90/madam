<div class="col-xs-12 col-lg-6">
    <h4><?=Yii::t('main','Составьте вопросы')?></h4>
    <div class="form-group">
        <div class="col-xs-12">
            <button type="button" id="remove-question" class="btn btn-danger pull-right"><?= Yii::t('main','Удалить')?> <span class="hidden-xs question-text"><?=Yii::t('main','вопрос')?></span></button>
            <button type="button" id="add-question" class="btn btn-success pull-left"><?= Yii::t('main','Добавить')?> <span class="hidden-xs question-text"><?=Yii::t('main','вопрос')?></span></button>
        </div>
    </div>
    <ul class="nav nav-tabs">
        <?php $count=1;?>
        <?foreach($questions as $id=>$question):?>
            <li data-count="<?=$count?>" class="<?if($count==1):?>active<?endif?>">
                <?=CHtml::link('<span class="hidden-xs question-text">' . Yii::t('main','Вопрос').'</span> '.$count,array('RequestFormController/index','#'=>'q'.$count++),array('data-toggle'=>'tab'))?>
            </li>
        <?endforeach;?>
    </ul>
    <div id="question-tab" class="tab-content">
        <? $count=0;?>
        <?foreach($questions as $id=>$question):?>
            <div class="tab-pane <?if(++$count==1):?>active<?endif?>" id="q<?=$count?>">
                <?=CHtml::hiddenField("question[".$count."][id]",$id)?>
                <div class="col-xs-12">
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
                                <div class="col-xs-10 col-sm-6">
                                    <?=CHtml::textField('question['.$count.'][text]',$question->text,array('class'=>'form-control'));?>
                                </div>
                                <div class="col-xs-2 col-sm-2">
                                    <div class="btn has-popover pull-right" data-content='<?= Yii::t('main', 'Текст вопроса. Сам вопрос может содержать один или несколько ответов, от которых зависит общее время термина и выбор работника (условия выбора работника указываются в "профиле Работника" - подраздел "Типы назначений")')?>' data-placement="left" data-original-title="" title=""><i class="icon-question"></i></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-4 control-label"><?=Yii::t('main','Подсказка к вопросу')?>:</label>
                                <div class="col-xs-10 col-sm-6">
                                    <?= CHtml::textArea("question[".$count."][hint]",$question->hint,array('class'=>'form-control','rows'=>3))?>
                                </div>
                                <div class="col-xs-2 col-sm-2">
                                    <div class="btn has-popover pull-right" data-content="<?= Yii::t('main', 'Подсказка выводится под вопросом мелким шрифтом')?>" data-placement="left" data-original-title="" title=""><i class="icon-question"></i></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <label class="col-xs-12 control-label text-label-important">
                                        <?=CHtml::radioButton("question[".$count."][type]",$question->type=='radio'?true:false,array('value'=>'radio','id'=>'optionsRadios1'))?>
                                        <?=Yii::t('main','Только один ответ')?>
                                    </label>
                                    <label class="col-xs-12 control-label text-label-important">
                                        <?=CHtml::radioButton("question[".$count."][type]",$question->type=='check'?true:false,array('value'=>'check','id'=>'optionsRadios2'))?>
                                        <?=Yii::t('main','Несколько ответов')?>
                                    </label>
                                </div>
                            </div>
                            <?if(count($questions)>1 && $license['license']->control_dialog==1):?>
                                <?
                                    $simple = $param['simple'];
                                    unset($simple[$id]);
                                ?>

                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <label class="col-xs-12 control-label text-label-important">
                                            <?= CHtml::dropDownList("question[".$count."][next_question]",$question->next_question,$simple,array('class'=>'form-control change-next'))?>
                                        </label>
                                    </div>
                                </div>
                            <?endif;?>
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
                                        <div class="box-content col-xs-12">
                                            <div class="form-group">
                                                <label class="col-xs-12"><?=Yii::t('main','Ответ')?></label>

                                                <div class="col-xs-10">
                                                    <?=CHtml::textField("question[".$count."][answer][".$countAnswer."][text]",$answer->text,array('class'=>'form-control'))?>
                                                </div>
                                                <div class="col-xs-2">
                                                    <div class="btn has-popover pull-right" data-content="<?= Yii::t('main', 'Текст ответа на вопрос')?>" data-placement="left" data-original-title="" title=""><i class="icon-question"></i></div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-xs-12 col-sm-6">
                                                    <label>MIN</label>
                                                    <?=CHtml::numberField("question[".$count."][answer][".$countAnswer."][min]",$answer->min,array('class'=>'form-control'))?>
                                                </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                        <label>ABBR</label>
                                                        <?=CHtml::textField("question[".$count."][answer][".$countAnswer."][abbr]",$answer->abbr,array('class'=>'form-control'))?>
                                                    </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-xs-12">
                                                    <label><?=Yii::t('main','Примечания')?></label>
                                                </div>
                                                <div class="col-xs-6">
                                                    <?=CHtml::textArea("question[".$count."][answer][".$countAnswer."][hint]",$answer->hint,array('class'=>"form-control","rows"=>3))?>
                                                </div>
                                                <div class="col-xs-2">
                                                    <div class="btn has-popover pull-right" data-content="<?= Yii::t('main', 'Примечания для администратора компании')?>" data-placement="left" data-original-title="" title=""><i class="icon-question"></i></div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="btn-group dropdown visability-hidden">
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
                                                <?if(count($questions)>1 && $license['license']->control_dialog==1):?>
                                                    <?
                                                        $simple = $param['simple'];
                                                        unset($simple[$id]);
                                                    ?>
                                                    <div class="col-xs-5">
                                                        <label><?= Yii::t('main','Следущий вопрос')?></label>
                                                        <?= CHtml::dropDownList("question[".$count."][answer][".$countAnswer."][next_question]",$answer->next_question,$simple,array('class'=>'form-control change-next'))?>
                                                    </div>
                                                <?endif;?>
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
<div class="col-xs-12 col-lg-6">
    <h4><?= Yii::t('main','Составление вопросов')?></h4>
                <span>
                    <?= Yii::t('main','При добавлении вопросов и соответствующих вариантов ответов вы можете указывать длительность термина. При добавлении ответов выставляйте продолжительность в минутах, общая продолжительность термина будет рассчитываться автоматически и учитываться при выборе времени назначения термина для клиента. Так же вы можете привязывать работников и доступные интервалы времени к определенным ответам (профиль Работника). Если в лицензии доступен "Диалоговый режим", то вы можете устанавливать последовательность вопросов.')?>
                </span>
</div>