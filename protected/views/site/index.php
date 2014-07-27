<?php
/* @var $this SiteController */
?>
<? if ($status == 1): ?>
    <div class="splash card">
        <div role="spinner">
            <div class="spinner-icon"></div>
        </div>
        <img class="img-circle" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">

        <p class="lead" style="text-align:center"><?=Yii::t('main','Ваша заявка принята')?></p>

        <div class="progress">
            <div class="mybar" role="bar">
            </div>
        </div>
    </div>
<? endif; ?>

