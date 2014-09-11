<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped',
    'template'=>"{items}{pager}",
    'filter'=>$model,
    'afterAjaxUpdate' => 'reinstallDatePicker', // #1()
    'dataProvider'=>$model->search(),
    'enablePagination'=>true,
    'summaryText'=>'Displaying {start}-{end} of {count} results.',
    'template' => "{summary}{items}{pager}",
    'pager' => array('class' => 'CLinkPager', 'header' => ''),
    'columns'=>array(
        array(
            'name' => 'date',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'date',
                    'language' => 'ru',
                     'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
                    'htmlOptions' => array(
                        'id' => 'datepicker_for_due_date',
                        'size' => '10',
                    ),
                    'defaultOptions' => array(  // (#3)
                        'showOn' => 'focus',
                        'dateFormat' => 'yy-mm-dd',
                        'showOtherMonths' => true,
                        'selectOtherMonths' => true,
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showButtonPanel' => true,
                    )
                ),
                true), // (#4)
        ),
        array(
            'name' => 'companyId',
            'type' => 'raw',
            'value' => '$data["company"]->id',
        ),
        array(
            'name' => 'name',
            'type' => 'raw',
            'value' => '$data["company"]->name',
        ),
        array(
            'header' =>'Level',
            'value' => '$data["license"]->base_lvl==null ? "Индивидуальная" : $data["license"]->base_lvl',
        ),
        array(
            'type' => 'raw',
            'value' => '$data["license"]->price==0 ? CHtml::link("<button type=\"button\"  class=\"btn btn-info\">Установить цену</button>",
                         array("adminLicense/setPrice","id" => $data["license"]->id))
                         : CHtml::link("<button type=\"button\" class=\"btn btn-primary\">Оплатить</button>",array("adminCompany/payment","id" => $data->id))',
        ),
        array(
            'type' => 'raw',
            'value' => '$data["license"]->price > 0 ?
                CHtml::link("<button type=\"button\" value=\"1\" name=\"save\" class=\"btn btn-success\">Подтвердить</button>",array("adminCompany/approve","id" => $data->id)) : ""',
        ),
    ),
));
// (#5)
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_due_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['ru'],{'dateFormat':'yy-mm-dd'}));
}
");