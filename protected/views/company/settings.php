<?php
$this->layout = 'companyLayout';
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
        'role'=>"form"
    ),
)); ?>

<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="/#settings" role="tab" data-toggle="tab">Настройки</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="settings">
        <div class="col-sm-8 col-xs-12">
            <div class="form-group">
                <?php echo $form->label($model,'url',array('class'=>"col-xs-6 control-label")); ?>
                <div class="col-xs-12 col-sm-4">
                    <?php echo $form->textField($model,'url',array('class'=>'form-control')) ?>
                    <?php echo $form->error($model,'url'); ?>
                </div>
                <div class="col-xs-1">
                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model,'booking_deadline',array('class'=>"col-xs-6 control-label")); ?>
                <div class="col-xs-12 col-sm-4">
                    <?=CHtml::dropDownList('Company[booking_deadline]',$model->booking_deadline,Company::$bookingDeadline,array('class'=>"form-control"))?>
                </div>
                <div class="col-xs-1">
                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model,'booking_interval',array('class'=>"col-xs-6 control-label")); ?>
                <div class="col-xs-12 col-sm-4">
                    <?=CHtml::dropDownList('Company[booking_interval]',$model->booking_interval,Company::$bookingInterval,array('class'=>"form-control"))?>
                </div>
                <div class="col-xs-1">
                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <?php echo $form->label($model,'enable_mail_notice',array('class'=>"col-xs-6 control-label")); ?>
                <div class="col-xs-12 col-sm-4">
                    <label class="checkbox-inline">
                        <?php echo $form->checkBox($model,'enable_mail_notice') ?>
                    </label>
                </div>
                <div class="col-xs-1">
                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model,'mail_notice_address',array('class'=>"col-xs-6 control-label")); ?>
                <div class="col-xs-12 col-sm-4">
                    <?php echo $form->textField($model,'mail_notice_address',array('class'=>'form-control')) ?>
                    <?php echo $form->error($model,'mail_notice_address'); ?>
                </div>
                <div class="col-xs-1">
                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <?php echo $form->label($model,'enable_sms_notice',array('class'=>"col-xs-6 control-label")); ?>
                <div class="col-xs-12 col-sm-4">
                    <label class="checkbox-inline">
                        <?php echo $form->checkBox($model,'enable_sms_notice') ?>
                    </label>
                </div>
                <div class="col-xs-1">
                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model,'sms_notice_phone',array('class'=>"col-xs-6 control-label")); ?>
                <div class="col-xs-12 col-sm-4">
                    <?php echo $form->textField($model,'sms_notice_phone',array('class'=>'form-control')) ?>
                    <?php echo $form->error($model,'sms_notice_phone'); ?>
                </div>
                <div class="col-xs-1">
                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <?php echo $form->label($model,'hello_text',array('class'=>"col-xs-6 control-label")); ?>
                <div class="col-xs-12 col-sm-4">
                    <?php echo $form->textArea($model,'hello_text',array('class'=>'form-control')) ?>
                    <?php echo $form->error($model,'hello_text'); ?>
                </div>
                <div class="col-xs-1">
                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->label($model,'select_timetable',array('class'=>"col-xs-6 control-label")); ?>
                <div class="col-xs-12 col-sm-4">
                    <label class="checkbox-inline">
                        <?php echo $form->checkBox($model,'select_timetable') ?>
                    </label>
                </div>
                <div class="col-xs-1">
                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                </div>
            </div>
            <div class="form-group">
                <hr>
                <div class="col-xs-offset-7 col-xs-5">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-xs-12">
            <span>
                <h4>Онлайн-бронирование назначение</h4>
                Регистр онлайн-бронирования назначение ., принять общие настройки для вашего онлайн-бронирования назначения на какое
                время диапазоны разблокирован для онлайн-бронирования назначения в Интернете, делают для
                индивидуальному графику одного ( Настройка&gt; вкладка Параметры расписания: Включить для онлайн-бронирования назначения ).
            </span>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>