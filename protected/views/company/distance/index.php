<?php
    $this->layout = 'companyLayout';
    Yii::app()->clientScript->registerScriptFile('/js/main.js');
    Yii::app()->clientScript->registerScript('init', 'distance.init()', CClientScript::POS_READY);
?>


<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="/#statement" role="tab" data-toggle="tab">Privacy Statement</a></li>
    <li class=""><a href="/#condition" role="tab" data-toggle="tab">Conditions</a></li>
    <li class=""><a href="/#reference" role="tab" data-toggle="tab">Reference</a></li>
    <li class=""><a href="/#terms" role="tab" data-toggle="tab">Terms and condition</a></li>
    <li><a href="/#imprint" role="tab" data-toggle="tab">Imprint</a></li>
</ul>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'distance-form',
    'enableClientValidation'=>false,
    'htmlOptions' => array('class' => 'form-horizontal')
)); ?>
<div class="tab-content">
    <div class="tab-pane active" id="statement">
        <?php $this->renderPartial('/company/distance/_statement',array(
        'form'=>$form,
        'model'=>$model,
    )); ?>
    </div>
    <div class="tab-pane" id="condition">
        <?php $this->renderPartial('/company/distance/_condition',array(
            'form'=>$form,
            'model'=>$model,
        )); ?>
    </div>
    <div class="tab-pane" id="reference">
        <?php $this->renderPartial('/company/distance/_reference',array(
            'form'=>$form,
            'model'=>$model,
        )); ?>
    </div>
    <div class="tab-pane" id="terms">
        <?php $this->renderPartial('/company/distance/_terms',array(
            'form'=>$form,
            'model'=>$model,
        )); ?>
    </div>
    <div class="tab-pane" id="imprint">
        <?php $this->renderPartial('/company/distance/_imprint',array(
            'form'=>$form,
            'model'=>$model,
        )); ?>
    </div>
</div>
<div class="">
    <hr>
    <div class="col-lg-offset-5 col-lg-5">
        <button type="submit" class="btn btn-success">Сохранить</button>
    </div>
</div>
<? $this->endWidget(); ?>