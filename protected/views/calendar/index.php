<?
Yii::app()->clientScript->registerScriptFile('/js/jquery.fancybox.pack.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('modal', 'modal.init()', CClientScript::POS_READY);
Yii::app()->clientScript->registerCssFile('/css/jquery.fancybox.css');
?>

<div class="col-sm-12">
    <div class="box bordered-box blue-border" style="margin-bottom:0;">
        <div class="box-header blue-background">
            <div class="title">Responsive table</div>
            <div class="actions">
                <a class="btn box-remove btn-xs btn-link" href="#"><i class="icon-remove"></i>
                </a>

                <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                </a>
            </div>
        </div>
        <div class="box-content box-no-padding">
            <?php $this->widget('DayCalendarWidget',array('user' => $user)); ?>
        </div>
    </div>
</div>