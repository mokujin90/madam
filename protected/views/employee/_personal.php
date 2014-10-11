<div class="col-xs-12 col-lg-6">
    <div class="form-group">
        <?= $form->labelEx($model,'login', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?=$form->emailField($model,'login', array('class' => "form-control", 'type' => 'email', 'required' => 'required')); ?>
            <?= $form->error($model,'login'); ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->labelEx($model,'password', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?=CHtml::textField('User[password]','', array('class' => "form-control")); ?>
            <?= $form->error($model,'password'); ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->labelEx($model,'name', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?=$form->textField($model,'name', array('class' => "form-control")); ?>
            <?= $form->error($model,'name'); ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->labelEx($model,'lastname', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?=$form->textField($model,'lastname', array('class' => "form-control")); ?>
            <?= $form->error($model,'lastname'); ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->labelEx($model,'description', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?=$form->textField($model,'description', array('class' => "form-control", 'placeholder'=>Yii::t('main',"Специальность"))); ?>
            <?= $form->error($model,'description'); ?>
        </div>
    </div>
    <?if(Company2License::enableGroupEvent()):?>
    <div class="form-group">
        <?= $form->labelEx($model,'group_size', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-10 col-sm-7">
            <?= $form->numberField($model, 'group_size', array('class' => "form-control", 'min' => 1,'max'=>20)); ?>
            <?= $form->error($model,'group_size'); ?>
        </div>
        <div class="col-xs-2 col-sm-1">
            <div class="btn has-popover pull-right" data-content="<?= Yii::t('main', 'Возможность создавать групповые события. Клиенты смогут заказывать термины на одно и то же время.')?>" data-placement="left" data-original-title="" title=""><i class="icon-question"></i></div>
        </div>
    </div>
    <?endif?>
    <div class="form-group">
        <?= $form->labelEx($model,'calendar_delimit', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-10 col-sm-7">
            <?
                $data =User::getCalendarDelimit();
                $select = !isset($data[$model->calendar_delimit]) ? 0 :  $model->calendar_delimit;
            ?>
            <?= CHtml::dropDownList('User[calendar_delimit]',$select,$data, array('class' => "form-control may-individual"))?>
            <?if(!isset($data[$model->calendar_delimit])):?>
                <?=$form->textField($model,'calendar_delimit', array('class' => "form-control manual-value", 'style'=>'margin-top: 5px;')); ?>
            <?endif;?>
            <?= $form->error($model,'calendar_delimit'); ?>
        </div>
        <div class="col-xs-2 col-sm-1">
            <div class="btn has-popover pull-right" data-content="<?= Yii::t('main', 'Интервалы на которые разбивается внутренний календарь работника.')?>" data-placement="left" data-original-title="" title=""><i class="icon-question"></i></div>
        </div>
    </div>
    <div class="form-group">
        <?
            $data =User::getCalendarDelimit();
            $select = !isset($data[$model->calendar_front_delimit]) ? 0 :  $model->calendar_front_delimit;
        ?>
        <?= $form->labelEx($model,'calendar_front_delimit', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-10 col-sm-7">

            <?= CHtml::dropDownList('User[calendar_front_delimit]',$select,$data, array('class' => "form-control may-individual"))?>
            <?if(!isset($data[$model->calendar_front_delimit])):?>
                <?=$form->textField($model,'calendar_front_delimit', array('class' => "form-control manual-value", 'style'=>'margin-top: 5px;')); ?>
            <?endif;?>
            <?= $form->error($model,'calendar_front_delimit'); ?>
        </div>
        <div class="col-xs-2 col-sm-1">
            <div class="btn has-popover pull-right" data-content="<?= Yii::t('main', 'Интервалы на которые разбивается календарь при бронировании через виджет.')?>" data-placement="left" data-original-title="" title=""><i class="icon-question"></i></div>
        </div>
    </div>
    <?if(!$model->isNewRecord && Company2License::enableOption('caldav')):?>
    <div class="form-group">
        <label class="col-xs-12 col-sm-4 control-label">CalDav ID</label>
        <div class="col-xs-10 col-sm-7">
            <input class="form-control" value="<?=$model->id?>">
        </div>
        <div class="col-xs-2 col-sm-1">
            <div class="btn has-popover pull-right" data-content="http://caldav.wconsults.ru/ cal.php/principals/<b>{CalDavID}</b>/<br>login: <b>{CalDavID}</b><br>password: <b>{userPassword}</b>" data-placement="left" data-title="CalDav Settings:" data-original-title="" title=""><i class="icon-question"></i></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-4 control-label">CalDav URI</label>
        <div class="col-xs-12 col-sm-8">
            <input class="form-control" value="http://caldav.wconsults.ru/cal.php/principals/<?=$model->id?>/">
        </div>
    </div>
    <?endif?>
</div>