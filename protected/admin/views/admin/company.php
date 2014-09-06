<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped',
    'template'=>"{items}\n{pager}",
    'filter'=>$model,
    'dataProvider'=>$model->search(),
    'enableSorting'=>true,
    'enablePagination'=>true,
    'summaryText'=>'Displaying {start}-{end} of {count} results.',
    'template' => "{summary}{items}{pager}",
    'pager' => array('class' => 'CLinkPager', 'header' => ''),
    'columns' => array(
        'id',
        'name',
        'description',
        'city',
        'address',
        'phone',
        'email',
        array(
            'name' => 'license',
            'filter'=>false,
            'type' => 'raw',
            'value' => 'CHtml::link(Yii::t("main","Лицензия"),
                         array("adminCompany/editLicense","id" => $data->company2Licenses[0]->id), array("class" => "btn btn-success"))',
        ),
        array(
            'type' => 'raw',
            'value' => 'CHtml::link($data->is_block ? Yii::t("main","Разблокировать") : Yii::t("main","Блокировать"),
                         array("adminCompany/changeBlockStatus","id" => $data->id, "status" => $data->is_block), array("class" => $data->is_block ? "btn btn-success" : "btn btn-inverse"))'
        ),
    ),
));