    <?
/**
 * @var $this WizardWidget
 * @var $field CompanyField[]
 * @var $question Question[]
 * @var $request Request
 */
Yii::app()->clientScript->registerCssFile('/css/datepicker3.css');

Yii::app()->clientScript->registerScriptFile('/js/dp/bootstrap-datepicker.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('/js/dp/locales/bootstrap-datepicker.ru.js', CClientScript::POS_HEAD);

Yii::app()->clientScript->registerScriptFile('/js/validate/jquery.validate.min.js', CClientScript::POS_HEAD);
if($this->wizardStep){
    Yii::app()->clientScript->registerScript('step', 'wizard.wizardStep()', CClientScript::POS_READY);
}


?>

<div class="dialog">
    <div style="position: relative;" class="box-content box-padding">
        <div class="fuelux">
            <div class="wizard">
                <ul class="steps">
                    <li class="active" data-target="#step1">
                        <span class="step">1</span>
                    </li>
                    <li data-target="#step2">
                        <span class="step">2</span>
                    </li>
                    <li data-target="#step3">
                        <span class="step">3</span>
                    </li>
                    <li data-target="#step4">
                        <span class="step">4</span>
                    </li>
                </ul>
                <div style="display: none;" class="actions">
                    <button id="btn-prev" class="btn btn-xs btn-prev"><i class="icon-arrow-left"></i><?= Yii::t('main','Назад')?>
                    </button>
                    <button  id="btn-next" class="btn btn-xs btn-success btn-next" data-last="Finish">
                        <?= Yii::t('main','Далее')?>
                        <i class="icon-arrow-right"></i>
                    </button>
                </div>
            </div>
            <div class="step-content">
                <hr class="hr-normal">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'action'=>Yii::app()->createUrl('wizard/index',array('id'=>$companyId)),
                    'htmlOptions' => array(
                        'class' => 'form',
                        'id'=>'wizard-form',
                        'style'=>'margin-bottom: 0;'
                    )
                )); ?>
                    <input name="authenticity_token" type="hidden">
                    <?php echo CHtml::hiddenField('companyId',$companyId)?>
                    <?if(!$request->isNewRecord):?>
                        <?php echo CHtml::hiddenField('requestId',$request->id)?>
                    <?endif;?>
                    <?php echo CHtml::hiddenField('jsonResult','',array('id'=>'jsonResult'))?>
                    <div class="step-pane active" id="step1" data-type="question">
                        <div class="col-xs-12"><?=$company->hello_text?></div> <br/>
                        <div class="form-group">
                            <?$numItems = count($question);
                            $i = 0;?>
                            <?foreach($question as $item):?>
                                <?
                                    $this->render('oneQuestion',array('question'=>$item,'request'=>$request,'showAgree'=>$showAgree));
                                ?>

                                <?if(++$i !== $numItems):?>
                                    <hr class="hr-normal">
                                <?endif;?>
                            <?endforeach?>

                        </div>
                    </div>

                    <div class="step-pane" id="step2" data-type="fields">
                        <div class="col-xs-12 col-sm-4">
                            <div id="schedule-date">
                            </div>
                            <div id="user-list" class="box">

                            </div>
                        </div>
                        <div id="available-time" class="col-xs-12 col-sm-8">

                        </div>
                    </div>

                    <div class="step-pane" id="step3" data-type="fields">
                        <div class="form-group">
                            <div class="controls">
                                <?$numItems = count($field);
                                    $i = 0;?>
                                <?foreach($field as $item):?>
                                    <?
                                        $value=  $request->isNewRecord ?  null :(isset($request['requestFields'][$item->id]) ? $request['requestFields'][$item->id]->value : null);
                                    ?>
                                    <?=$this->drawField($item,$value)?>
                                <?if(++$i !== $numItems):?>
                                    <hr class="hr-normal">
                                <?endif;?>
                                <?endforeach?>
                                <hr class="hr-normal">
                                <?= $form->labelEx($request,'comment', array('class' => "init control-label")); ?>
                                <div class="controls">
                                    <?= $form->textarea($request,'comment', array('class' => "form-control")); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step-pane" id="step4" data-type="total">

                    </div>

                <button name="save" value="1" id="save" hidden style="display: none" type="submit">finish</button>
                <? $this->endWidget(); ?>

            </div>
            <div style="margin-top: 10px; float:right;clear:both;width: 123px;height: 25px;" class="wizard">

                <div class="actions-fake">
                    <button class="btn btn-xs btn-prev"><i class="icon-arrow-left"></i><?= Yii::t('main','Назад')?>
                    </button>
                    <button class="btn btn-xs btn-success btn-next" data-last="Finish">
                        <?= Yii::t('main','Далее')?>
                        <i class="icon-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        <?$interval = $this->getEventDateInterval()?>
        var globalStartDate = "<?=$interval['start']?>";
        var globalEndDate = "<?=$interval['end']?>";
        function addZero(num){
            return parseInt(num) < 10 ? ('0' + num) : num;
        }
        $(function(){
            $('#schedule-date').datepicker({
                format: "yyyy-mm-dd",
                weekStart: 1,
                startDate: globalStartDate,
                endDate: globalEndDate,
                language: "ru",
                maxViewMode: 1
            }).bind('changeDate', function(){
                        $('.btn-next').addClass('disabled');
                        $('#user-list').empty();
                        var userData = JSON.parse($('#jsonResult').val());

                        var dateVal = $('#schedule-date').datepicker('getDate');
                        var day = dateVal.getDate();
                        var month = dateVal.getMonth() + 1;
                        var year = dateVal.getFullYear();
                        dateVal = year + "-" + addZero(month) + "-" + addZero(day);

                        $.ajax({
                            type: 'GET',
                            url: '/calendar/getAvailableTime',
                            async: true,
                            dataType: 'html',
                            data: {
                                duration: userData.time,
                                id: userData.user_id,
                                schedule_id: userData.schedule_id,
                                date: dateVal
                            },
                            error: function () {
                                $.jGrowl("<?=Yii::t('main','Ошибка сервера')?>");
                            },
                            success: function (data) {
                                $('#available-time').html(data);
                            }
                        });
                    });

            $(document).on('click', '.time-selection', function(){
                $.ajax({
                    type: 'GET',
                    url: '/calendar/getUserList',
                    async: true,
                    dataType: 'html',
                    data: {
                        id: $(this).closest('.event').attr('data-user-id')
                    },
                    error: function () {
                        $.jGrowl("<?=Yii::t('main','Ошибка сервера')?>");
                    },
                    success: function (data) {
                        $('#user-list').html(data);
                        $('.btn-next').removeClass('disabled');
                    }
                });
            });
            $('.wizard').bind('nextstep2', function(){
                $('#user-list, #available-time').empty();
                $('#schedule-date .day.active').removeClass('active');
            })
        })
    </script>
