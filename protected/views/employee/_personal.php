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
            <?=$form->textField($model,'password', array('class' => "form-control", 'required' => 'required')); ?>
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
            <?=$form->textField($model,'description', array('class' => "form-control", 'placeholder'=>"Специальность")); ?>
            <?= $form->error($model,'description'); ?>
        </div>
    </div>
    <?if(Company2License::enableGroupEvent()):?>
    <div class="form-group">
        <?= $form->labelEx($model,'group_size', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-10 col-sm-7">
            <?= $form->numberField($model, 'group_size', array('class' => "form-control", 'min' => 1)); ?>
            <?= $form->error($model,'group_size'); ?>
        </div>
        <div class="col-xs-2 col-sm-1">
            <div class="btn has-popover pull-right" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="left" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
        </div>
    </div>
    <?endif?>
    <div class="form-group">
        <?= $form->labelEx($model,'calendar_delimit', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-10 col-sm-7">
            <?= $form->dropDownList($model, 'calendar_delimit', User::$calendarDelimit, array('class' => "form-control")); ?>
            <?= $form->error($model,'calendar_delimit'); ?>
        </div>
        <div class="col-xs-2 col-sm-1">
            <div class="btn has-popover pull-right" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="left" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
        </div>
    </div>
    <div class="form-group">
        <?$data = User::$calendarDelimit + array('-1' => 'Автоматически');?>
        <?= $form->labelEx($model,'calendar_front_delimit', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-10 col-sm-7">
            <?= $form->dropDownList($model, 'calendar_front_delimit', $data, array('class' => "form-control")); ?>
            <?= $form->error($model,'calendar_front_delimit'); ?>
        </div>
        <div class="col-xs-2 col-sm-1">
            <div class="btn has-popover pull-right" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="left" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
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