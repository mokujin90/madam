<div class="row">
        <div class="box">
            <div class="box-header green-background">
                <div class="title"><i class="icon-comments-alt"></i> <?=Yii::t('main','Пользовательские поля')?></div>
            </div>
            <div class="box-content box-no-padding">
                <div class="form-group">
                    <div class="controls">
                        <?foreach($field as $item):?>
                            <?=$this->drawField($item)?>
                        <?endforeach?>
                    </div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-header blue-background">
                <div class="title"><i class="icon-book"></i> <?=Yii::t('main','Вопросы')?></div>
            </div>
            <div class="box-content box-no-padding">
                <div class="form-group">
                    <?foreach($question as $item):?>
                        <div class="question">
                            <div class="col-xs-12">
                                <label class="control-label"><?=$item->text?></label>
                            </div>
                            <div class="form-group">
                                <?=$this->drawAnswer($item)?>
                            </div>
                        </div>
                    <?endforeach?>
                </div>
            </div>
        </div>

</div>





