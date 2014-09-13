<div class="col-xs-12 col-lg-6">
<h4><?= Yii::t('main','Внесите данные о пользователе')?></h4>
    <div class="form-group">
        <div class="col-xs-12">
            <button type="button" class="add-field btn btn-primary pull-left"><?=Yii::t('main','Добавить поле')?></button>
        </div>
    </div>
    <div class="form-group hidden-xs">
        <div class="col-sm-offset-3 col-sm-5">
            <?=Yii::t('main','Имя поля')?>
        </div>
        <div class="col-sm-4">
            <?=Yii::t('main','Параметр поля')?>
        </div>
    </div>
    <div id="fields">
        <?$count=0?>
        <?foreach($fields as $field):?>
            <div class="form-group">
                <div class="col-xs-12 col-sm-1">
                    <button type="button" class="col-xs-12 btn btn-primary up-field">&uarr;</button>
                </div>
                <div class="col-xs-12 col-sm-1">
                    <button type="button" class="col-xs-12 btn btn-primary down-field">&darr;</button>
                </div>
                <div class="col-xs-12 col-sm-1">
                    <?if($field->is_userfield==1):?><button type="button" class="col-xs-12 btn btn-danger remove-field">-</button><?endif;?>
                </div>
                <?= CHtml::hiddenField('field['.$count.'][id]',$field->id)?>
                <div class="col-xs-12 col-sm-5">
                    <?= CHtml::textField('field['.$count.'][name]',$field->name,array('readonly' => ($field->is_userfield!=1), 'class'=>"form-control"))?>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <?= CHtml::dropDownList('field['.$count.'][type]',$field->type, CompanyField::params(),array('class'=>'form-control' . ($field->is_userfield!=1 ? ' hidden' : '')));?>
                </div>
            </div>

            <?$count++?>
        <?endforeach;?>
        <?=CHtml::hiddenField('',$count,array('id'=>'count-field'))?>
    </div>
    <div id="button-panel" class="form-group">
        <hr>
            <button type="submit" class="btn btn-success pull-right"><?=Yii::t('main','Сохранить')?></button>
    </div>
</div>
<div class="col-xs-12 col-lg-6">
    <h4><?= Yii::t('main','Данные пользователя')?></h4>
            <span>
                <?= Yii::t('main','  В реестре сведения о компании и выбрать приложение, установить состояние и введите свой ​​адрес и контактную один ..
                О применении быть предустановлен промышленность особые условия и поля даты. Via выбора государства календаря автоматически заполняется с официальных
                государственных праздников. адрес и контактная информация отображаются в онлайн-бронирования назначения в адрес поля. наконечником: Если вы перемещаете
                указатель мыши в знак вопроса, окна объяснение здесь появится на поле справа.')?>

            </span>
</div>