<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'date',
        array(
            'name' => 'name',
            'type' => 'raw',
            'value' => '$data["company"]->name',
        ),
        array(
            'name' => 'type',
            'type' => 'raw',
            'value' => '$data["license"]->base_lvl==null ? "Индивидуальная" : $data["license"]->base_lvl',
        ),
        array(
            'name' => 'approv',
            'type' => 'raw',
            'value' => 'CHtml::link("<button type=\"button\" value=\"1\" name=\"save\" class=\"btn btn-success\">Оплатить</button>",
                         array("AdminCompany/approve","id" => $data->id))',
        ),
    ),
));