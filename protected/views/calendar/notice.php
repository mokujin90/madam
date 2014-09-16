<?
/**
 * @var $user User
 * @var $model Request
 * @var $license Company2License
 * @var $license['license'] License
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'htmlOptions'=>array(
        'class'=>'form-horizontal fancybox-form',
        'role'=>"form",
        'id'=>'notice-form',
    ),
)); ?>
<ul class="nav nav-tabs" role="tablist">
    <?$i=0;?>
    <?if($license['license']->email_event==1):?>
        <li class="<?if($i++==0):?>active<?endif?>"><a href="/#mail" role="tab" data-toggle="tab">Почта</a></li>
    <?endif;?>
    <?if($license['license']->sms_event==1):?>
        <li class="<?if($i++==0):?>active<?endif?>"><a href="/#sms" role="tab" data-toggle="tab">SMS</a></li>
    <?endif;?>

</ul>
<div class="tab-content">
    <?$i=0;?>
    <?if($license['license']->email_event==1):?>
        <div class="tab-pane <?if($i++==0):?>active<?endif?>" id="mail">
            <?php echo CHtml::textArea('mail_text','', array('rows' => 10, 'class' => 'col-xs-12 form-control'))?>
            <div>
                <button name="save" value="mail" class="send-mail btn btn-success" type="submit"><i class="icon-envelope"></i> <?php echo Yii::t('main','Отправить')?></button>
                <button href="<?=$this->createUrl('calendar/event',array('user_id'=>$model->user_id,'id'=>$model->id))?>"  class="btn btn-primary event" type="button"><?php echo Yii::t('main','Отменить')?></button>
            </div>

        </div>
    <?endif;?>
    <?if($license['license']->sms_event==1):?>
        <div class="tab-pane <?if($i++==0):?>active<?endif?>" id="sms">
            <?php echo CHtml::textArea('sms_text','', array('rows' => 10, 'class' => 'col-xs-12 form-control'))?>
            <div>
                <button name="save" value="sms" class="send-sms btn btn-success" type="submit"><i class="icon-envelope"></i> <?php echo Yii::t('main','Отправить')?></button>
                <button href="<?=$this->createUrl('calendar/event',array('user_id'=>$model->user_id,'id'=>$model->id))?>"  class="btn btn-primary event" type="button"><?php echo Yii::t('main','Отменить')?></button>
            </div>
        </div>
    <?endif;?>



</div>
<?=CHtml::hiddenField('user_id',$model->user_id,array('id'=>'user_id'))?>
<?=CHtml::hiddenField('request_id',$model->id,array('id'=>'request_id'))?>

<?php $this->endWidget(); ?>
<script type="text/javascript">
    $('.send-mail,.send-sms').click(function(){
        var $form = $('#notice-form'),
            user_id = $form.find('input[name="user_id"]').val(),
            id =  $form.find('input[name="request_id"]').val(),
            serialize = $form.serializeArray();
        serialize.push({'name':'save','value':$(this).val()});
        $.post( "/calendar/notice/user_id/"+user_id+"/id/"+id,serialize, function( data ) {
            $.fancybox.close();
            var data = JSON.parse(data);
            if( typeof data.message != "undefined" ){
                $.jGrowl(data.message);
            }
        });
        return false;
    });
</script>
