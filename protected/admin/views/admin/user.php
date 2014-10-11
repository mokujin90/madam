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
        'login',
        'is_owner',
        'name',
        'lastname',
        array(
            'name' => 'company',
            'type' => 'raw',
            'value' => '$data["company"]->name',
        ),
        array(
            'type' => 'raw',
            'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success\">".Yii::t("main","Войти")."</button>",array("site/autoLogin","id" => $data->id,"hash"=>$data->password))',
        ),
    ),
));