<?php $form=$this->beginWidget('CActiveForm', array(
    'htmlOptions'=>array(
        'class'=>'form-horizontal fancybox-form',
        'role'=>"form",
        'id'=>'notice-form',
    ),
)); ?>
<button class="cancel btn btn-primary" type="button"><?=Yii::t('main','Отменить')?></button>

<button name="remove" class="action-ajax btn btn-success" type="submit"><i class="icon-unlock"></i> <?php echo Yii::t('main','Разблокировать интервал')?></button>

<?=CHtml::hiddenField('user_id',$model->user_id,array('id'=>'user_id'))?>
<?=CHtml::hiddenField('request_id',$model->id,array('id'=>'request_id'))?>

<?php $this->endWidget(); ?>
<script type="text/javascript">
    $('.action-ajax').click(function(){
        var $form = $('#notice-form'),
                user_id = $form.find('input[name="user_id"]').val(),
                id =  $form.find('input[name="request_id"]').val(),
                serialize = $form.serializeArray();
        serialize.push({'name':'remove','value':1});
        $.post( "/calendar/freeInterval/user_id/"+user_id+"/id/"+id,serialize, function( data ) {
            $.fancybox.close();
            var $wrap = $('#' + $('#calendar-tabs .active').data('tab') + '-calendar');
            calendar.refresh($('.current-date', $wrap).data('date'));
        });
        return false;
    });
</script>