<?if(count($findResult)==0):?>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-content">
                    <h4 class=" text-contrast text-center">
                        <?=Yii::t('main','Подходящих под ваш запрос событий не найдено')?>
                    </h4>
                </div>
            </div>
        </div>
    </div>
<?else:?>
    <?foreach($findResult as $request):?>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-content">
                    <h4>
                        <?=CHtml::link(
                            ($request->start_time . " - " . $request->end_time),
                            array('calendar/event',
                                'user_id' => $request->user_id,
                                'id' =>$request->id
                            ),
                            array(
                                'class' => "event text-contrast",
                            ))?>
                    </h4>
                    <p>
                        <?foreach ($request->requestFields as $field):?>
                            <?="{$field->field->name}: <b>{$field->value}</b>"?><br>
                        <?endforeach?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?endforeach?>
<?endif?>