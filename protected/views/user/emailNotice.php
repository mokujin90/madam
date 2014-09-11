<?php
/* @var $this SiteController */
$this->layout = 'sign';
?>

<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <h1 class="text-center title"><?= Yii::t('main','Спасибо, что зарегестрировлись')?></h1>

                В ближайшее время Вам придет письмо с кодом подтверждения.

            <div class="text-center">
                <hr class="hr-normal">
                <?php echo CHtml::link(Yii::t('main','На главную'),array('user/login'),array())?>
                <!--a href="#">Forgot your password?</a-->
            </div>
        </div>
    </div>
</div>
