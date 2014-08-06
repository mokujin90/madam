<?php Yii::app()->clientScript->registerScript('findInit', 'calendar.search()', CClientScript::POS_READY);?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'htmlOptions'=>array(
        'role'=>"form",
        'id'=>'find-event',
        'class' => 'form form-horizontal'
    ),
)); ?>
    <div class="col-sm-12">
        <div class="box bordered-box blue-border" style="margin-bottom:0;">
            <div class="box-header blue-background"><div class="title"><?=Yii::t('main','Поиск по полям')?></div></div>
            <div class="box-content">
                <div class="form-group">
                    <?php echo $form->labelEx($find,'field',array('class'=>'col-md-2 control-label'))?>
                    <div class="col-md-5">
                        <?php echo $form->textField($find,'field',array('class'=>'form-control')) ?>
                    </div>

                </div>
            </div>
        </div>
        <div class="box bordered-box blue-border" style="margin-bottom:0;">
            <div class="box-header blue-background"><div class="title"><?=Yii::t('main','Поиск по датам')?></div></div>
            <div class="box-content">
                <div class="form-group">
                    <?php echo $form->labelEx($find,'startDate',array('class'=>'col-md-2 control-label'))?>
                    <div class="col-md-5">
                        <div class="datepicker-input input-group pull-right" id="calendar-datepicker" data-date-format="DD/MM/YYYY">
                            <?php echo $form->textField($find,'startDate',array('class'=>'form-control', 'id'=>"start_date")) ?><span class="input-group-addon"><span data-date-icon="icon-calendar" data-time-icon="icon-time" class="icon-calendar"></span></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($find,'endDate',array('class'=>'col-md-2 control-label'))?>
                    <div class="col-md-5">
                        <div class="datepicker-input input-group pull-right" id="calendar-datepicker" data-date-format="DD/MM/YYYY">
                            <?php echo $form->textField($find,'endDate',array('class'=>'form-control', 'id'=>"end_date")) ?><span class="input-group-addon"><span data-date-icon="icon-calendar" data-time-icon="icon-time" class="icon-calendar"></span></span>
                        </div>
                    </div>

                </div>

                <button name="find" value="1" class="find btn btn-success" type=""><i class="icon-find"></i> <?=Yii::t('main','Поиск')?></button>
                <div class="box" style="margin-top: 20px" id="search-result">

                </div>
            </div>
        </div>
    </div>
<?php $this->endWidget(); ?>