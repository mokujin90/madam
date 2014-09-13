<?
    Yii::app()->clientScript->registerCssFile('/css/jquery.fancybox.css');
    Yii::app()->clientScript->registerScriptFile('/js/jquery.min.js', CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile('/js/jquery.fancybox.pack.js', CClientScript::POS_HEAD);

/**
 * @var $info Distance
 */
?>
    <script>
        $(".fancy").fancybox({});
    </script>
        <style>
            .fancy{

            }
        </style>
<?php echo CHtml::link(Yii::t('main','Click Me'),'/wizard/index/id/' . Yii::app()->user->companyId,array('data-fancybox-type'=>"iframe",'class'=>'fancy col-xs-12 text-center btn btn-primary btn-lg'))?>