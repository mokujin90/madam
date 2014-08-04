<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped',
    'dataProvider' => $dataProvider,
    'columns' => array(
        'name',
        'description',
        'city',
        'address',
        'phone',
        'email',
        array(
            'name' => 'license',
            'type' => 'raw',
            'value' => 'CHtml::link(Yii::t("main","Лицензия"),
                         array("AdminCompany/editLicense","id" => $data->company2Licenses[0]->id))',
        ),
    ),
));