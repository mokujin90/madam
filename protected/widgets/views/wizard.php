<?
/**
 * @var $this WizardWidget
 * @var $field CompanyField[]
 * @var $question Question[]
 */
Yii::app()->clientScript->registerScriptFile('/js/dp/bootstrap-datepicker.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('/js/dp/locales/bootstrap-datepicker.ru.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile('/css/datepicker3.css');
?>

<div class="dialog">
    <div class="box-content box-padding">
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
                <div class="actions">
                    <button class="btn btn-xs btn-prev"><i class="icon-arrow-left"></i>Prev
                    </button>
                    <button class="btn btn-xs btn-success btn-next" data-last="Finish">
                        Next
                        <i class="icon-arrow-right"></i>
                    </button>
                </div>
            </div>
            <div class="step-content">
                <hr class="hr-normal">
                <form class="form" style="margin-bottom: 0;" method="post">
                    <input name="authenticity_token" type="hidden">
                    <?php echo CHtml::hiddenField('companyId',$companyId)?>
                    <?php echo CHtml::hiddenField('jsonResult','',array('id'=>'jsonResult'))?>
                    <div class="step-pane active" id="step1" data-type="question">
                        <div class="form-group">
                            <?$numItems = count($question);
                            $i = 0;?>
                            <?foreach($question as $item):?>
                                <?
                                    $this->render('oneQuestion',array('question'=>$item));
                                ?>

                                <?if(++$i !== $numItems):?>
                                    <hr class="hr-normal">
                                <?endif;?>
                            <?endforeach?>

                        </div>
                    </div>

                    <div class="step-pane" id="step2" data-type="fields">
                        <div class="col-xs-4">
                            <div id="schedule-date">
                            </div>
                            <div id="user-list" class="box">

                            </div>
                        </div>
                        <div id="available-time" class="col-xs-8">

                        </div>
                    </div>

                    <div class="step-pane" id="step3" data-type="fields">
                        <div class="form-group">
                            <div class="controls">
                                <?$numItems = count($field);
                                    $i = 0;?>
                                <?foreach($field as $item):?>
                                    <?=$this->drawField($item)?>
                                <?if(++$i !== $numItems):?>
                                    <hr class="hr-normal">
                                <?endif;?>
                                <?endforeach?>
                            </div>
                        </div>
                    </div>

                    <div class="step-pane" id="step4" data-type="total">

                    </div>

                <button name="save" value="1" id="save" hidden style="display: none" type="submit">finish</button>
                </form>

            </div>
        </div>
    </div>
</div>
    <script>
        <?$interval = $this->getEventDateInterval()?>
        var globalStartDate = "<?$interval['start']?>";
        var globalEndDate = "<?$interval['end']?>";
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
                                date: dateVal
                            },
                            error: function () {
                                $.jGrowl("Ошибка сервера");
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
                        $.jGrowl("Ошибка сервера");
                    },
                    success: function (data) {
                        $('#user-list').html(data);
                    }
                });
            });
        })
    </script>
