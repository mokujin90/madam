<div class="col-xs-12 col-sm-8">
    <div class="form-group">
        <?= $form->labelEx($model,'login', array('class' => "col-xs-4 control-label")); ?>
        <div class="col-xs-4">
            <?=$form->emailField($model,'login', array('class' => "form-control", 'type' => 'email', 'required' => 'required')); ?>
        </div>
        <div class="col-xs-4">
            <?= $form->error($model,'login'); ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->labelEx($model,'password', array('class' => "col-xs-4 control-label")); ?>
        <div class="col-xs-4">
            <?=$form->textField($model,'password', array('class' => "form-control", 'required' => 'required')); ?>
        </div>
        <div class="col-xs-4">
            <?= $form->error($model,'password'); ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->labelEx($model,'name', array('class' => "col-xs-4 control-label")); ?>
        <div class="col-xs-4">
            <?=$form->textField($model,'name', array('class' => "form-control")); ?>
        </div>
        <div class="col-xs-4">
            <?= $form->error($model,'name'); ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->labelEx($model,'lastname', array('class' => "col-xs-4 control-label")); ?>
        <div class="col-xs-4">
            <?=$form->textField($model,'lastname', array('class' => "form-control")); ?>
        </div>
        <div class="col-xs-4">
            <?= $form->error($model,'lastname'); ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->labelEx($model,'description', array('class' => "col-xs-4 control-label")); ?>
        <div class="col-xs-4">
            <?=$form->textField($model,'description', array('class' => "form-control", 'placeholder'=>"Специальность")); ?>
        </div>
        <div class="col-xs-4">
            <?= $form->error($model,'description'); ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->labelEx($model,'group_size', array('class' => "col-xs-4 control-label")); ?>
        <div class="col-xs-4">
            <?= $form->numberField($model, 'group_size', array('class' => "form-control", 'min' => 1)); ?>
        </div>
        <div class="col-xs-1">
            <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
        </div>
        <div class="col-xs-3">
            <?= $form->error($model,'group_size'); ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->labelEx($model,'calendar_delimit', array('class' => "col-xs-4 control-label")); ?>
        <div class="col-xs-4">
            <?= $form->dropDownList($model, 'calendar_delimit', User::$calendarDelimit, array('class' => "form-control")); ?>
        </div>
        <div class="col-xs-1">
            <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
        </div>
        <div class="col-xs-3">
            <?= $form->error($model,'calendar_delimit'); ?>
        </div>
    </div>
    <div class="form-group">
        <?$data = User::$calendarDelimit + array('-1' => 'Автоматически');?>
        <?= $form->labelEx($model,'calendar_front_delimit', array('class' => "col-xs-4 control-label")); ?>
        <div class="col-xs-4">
            <?= $form->dropDownList($model, 'calendar_front_delimit', $data, array('class' => "form-control")); ?>
        </div>
        <div class="col-xs-1">
            <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
        </div>
        <div class="col-xs-3">
            <?= $form->error($model,'calendar_front_delimit'); ?>
        </div>
    </div>
    <div class="form-group">
        <?= $form->labelEx($model,'caldav', array('class' => "col-xs-4 control-label")); ?>
        <div class="col-xs-4">
            <?=$form->textField($model,'caldav', array('class' => "form-control")); ?>
        </div>
        <div class="col-xs-1">
            <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
        </div>
        <div class="col-xs-3">
            <?= $form->error($model,'caldav'); ?>
        </div>
    </div>
</div>