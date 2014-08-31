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
<?php echo CHtml::link('wizard','/wizard/index/id/1',array('data-fancybox-type'=>"iframe",'class'=>'fancy'))?>