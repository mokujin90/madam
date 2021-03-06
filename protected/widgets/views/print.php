<div class="row">
    <div class="box col-xs-12 col-sm-6">
        <div class="box-header green-background">
            <div class="title"><i class="icon-comments-alt"></i> <?=Yii::t('main','Пользовательские поля')?></div>
        </div>
        <div class="box-content">
            <div class="form-group">
                <div class="controls">
                    <?
                        foreach($field as $item){
                            echo "<b>".$item->name."</b>: ". (isset($request['requestFields'][$item->id]) ? $request['requestFields'][$item->id]->value : '---')."<br/>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="box col-xs-12 col-sm-6">
        <div class="box-header blue-background">
            <div class="title"><i class="icon-book"></i> <?=Yii::t('main','Вопросы')?></div>
        </div>
        <div class="box-content">
            <div class="form-group">
                <?foreach($question as $item):?>
                    <?
                        $result = array();
                        foreach($item['answers'] as $id => $answer){
                            if(isset($request['requestQuestions'][$id])){
                                $result[] = $answer->text;
                            }
                        }
                    ?>
                    <?if(count($result)):?>
                        <div class="question">
                            <div class="col-xs-12">
                                <label class="control-label"><?=$item->text?></label>
                            </div>
                            <div class="form-group">
                                <?= implode(', ',$result)?>
                            </div>
                        </div>
                    <?endif;?>
                <?endforeach?>
            </div>
        </div>
    </div>

</div>





