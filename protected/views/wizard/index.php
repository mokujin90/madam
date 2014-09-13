<?
    Yii::app()->clientScript->registerCssFile('/css/jquery.fancybox.css');

    Yii::app()->clientScript->registerScriptFile('/js/jquery.fancybox.pack.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScript('init', 'wizard.init()', CClientScript::POS_READY);
/**
 * @var $info Distance
 * @var $company Company
 */
?>
<div id="main-nav-bg"></div>
<nav id="main-nav" class="company-info">

    <div class="col-xs-12 company-info-wrap">
        <nav class="navbar navbar-default">
            <div class="navbar-brand"><?=Yii::t('main','Адрес')?></div>
        </nav>
        <div class="company-name col-xs-12">
            <div><?=$company->name?></div>
            <div><?=$company->description?></div>
        </div>
        <div class="company-address col-xs-12">
            <?if(!empty($company->address)):?>
                <div><i class="icon-home"></i> <?=$company->address?></div>
            <?endif;?>
            <?if(!empty($company->zip) || !empty($company->city)):?>
                <div><i class="icon-home"></i> <?=$company->zip?> <?=$company->city?></div>
            <?endif;?>

            <div><i class="icon-home"></i> <?=Yii::t('main', $company['country']->name)?></div>
        </div>
        <div class="company-phone col-xs-12">
            <?if(!empty($company->phone)):?>
                <div><i class="icon-phone"></i> <?=$company->phone?></div>
            <?endif;?>
            <?if(!empty($company->fax)):?>
                <div><i class="icon-print"></i> <?=$company->fax?></div>
            <?endif;?>

        </div>
        <div class="company-email col-xs-12">
            <?if(!empty($company->site)):?>
                <div><i class="icon-file-alt"></i> <?=$company->site?></div>
            <?endif;?>
            <?if(!empty($company->email)):?>
                <div><i class="icon-envelope"></i> <?=$company->email?></div>
            <?endif;?>

        </div>
        <div class="col-xs-12">
        <?if($info->show_term==1):?>
            <div><?=$info->getTermLink(Yii::t('main','Сроки и условия'))?></div>
        <?endif;?>
        <?if($info->param_imprint!=0):?>
            <div><?=$info->getImprintLink(Yii::t('main','Итоговые данные'))?></div>
        <?endif;?>
        </div>
    </div>
</nav>
<section id="content">
    <div class="container">
        <div class="row" id="content-wrapper">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-header">
                            <?if($company->issetLogo()):?>
                                <div class="pull-right wizard-logo">
                                    <?=CHtml::image('/'.$company->getLogoPath())?>
                                </div>
                            <?endif;?>
                            <h1 class="pull-left<?= $company->issetLogo() ? ' with-logo' : ''?>">
                                <i class="icon-magic"></i>
                                <span><?=$company->name?></span>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                            $this->widget('WizardWidget',array('company'=>$company,'question'=>$question,'field'=>$field,'companyId'=>$company->id,'wizardStep'=>$this->wizardStep,'request'=>isset($request) ? $request : null,'showAgree'=>$showAgree));
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <footer id="footer">
            <div class="footer-wrapper">
                <div class="row">
                    <div class="col-sm-6 text">
                        Copyright © 2013 <?=Yii::app()->name;?>
                    </div>

                </div>
            </div>
        </footer>
    </div>
</section>

<div class="hidden">
    <div id="privacy-block">
        <?=$info->text_privacy?>
    </div>
    <div id="condition-block">
        <?=$info->text_condition?>
    </div>
    <div id="term-block">
        <?=$info->text_term?>
    </div>
    <div id="imprint-block">
        <div><?=$info->address_imprint?></div>
        <div><?=$info->text_imprint_add?></div>
    </div>
</div>