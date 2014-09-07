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

    <div class="col-xs-12">
        <nav class="navbar navbar-default">
            <div class="navbar-brand"><?=Yii::t('main','Адрес')?></div>
        </nav>
        <div class="company-name col-xs-12">
            <?=$company->name?>
        </div>
        <div class="company-address col-xs-12">
            <div><?=$company->description?></div>
            <div><?=$company['country']->name?> <?=$company->address?>, <?=$company->city?></div>
        </div>
        <div class="company-phone col-xs-12">
            <div><?=Yii::t('main','Тел')?>.: <?=$company->phone?></div>
            <div><?=Yii::t('main','Мобильный')?>: <?=$company->mobile_phone?></div>
        </div>
        <div class="company-email col-xs-12">
            <div>E-mail: <?=$company->email?></div>
        </div>
        <?if($info->show_term==1):?>
            <div class="col-xs-12">
                <div><?=$info->getTermLink('Term and Conditions')?></div>
            </div>
        <?endif;?>
        <?if($info->param_imprint!=0):?>
            <div class="col-xs-12">
                <div><?=$info->getImprintLink('Imprint')?></div>
            </div>
        <?endif;?>
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
                                <div class="wizard-logo">
                                    <?=CHtml::image('/'.$company->getLogoPath())?>
                                </div>
                            <?endif;?>
                            <h1 class="pull-left">
                                <i class="icon-magic"></i>
                                <span><?=$company->name?></span>
                            </h1>

                            <div class="pull-right">
                                <!--ul class="breadcrumb">
                                    <li>
                                        <a href="index.html">
                                            <i class="icon-bar-chart"></i>
                                        </a>
                                    </li>
                                    <li class="separator">
                                        <i class="icon-angle-right"></i>
                                    </li>
                                    <li>
                                        Forms
                                    </li>
                                    <li class="separator">
                                        <i class="icon-angle-right"></i>
                                    </li>
                                    <li class="active">Wizard</li>
                                </ul-->
                            </div>
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
                        Copyright © 2013 Your Project Name
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