<?php
/* @var $this SiteController */
$this->layout = false;
Yii::app()->clientScript->registerScriptFile('/js/wizard.js', CClientScript::POS_END);

?>
<html class=" js no-touch localstorage svg">
<head>
    <script src="http://www.bublinastudio.com/flattybs3/assets/javascripts/jquery/jquery.min.js"
            type="text/javascript"></script>
    <!-- / bootstrap [required] -->
    <link href="/css/bootstrap.css" media="all" rel="stylesheet" type="text/css">
    <!-- / theme file [required] -->
    <link href="/css/wizard.css" media="all" rel="stylesheet" type="text/css">

    <link href="/css/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css">
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="/css/theme-colors.css" media="all" rel="stylesheet" type="text/css">
    <!-- / demo file [not required!] -->
    <link href="/css/demo.css" media="all" rel="stylesheet" type="text/css">

</head>
<body class="contrast-red ">
<div id="wrapper">
    <div id="main-nav-bg"></div>
    <nav id="main-nav">
        <div class="col-xs-12">
            <nav class="navbar navbar-default">
                <div class="navbar-brand">Адрес</div>
            </nav>
            <div class="company-name col-xs-12">
                Art-kos
            </div>
            <div class="company-address col-xs-12">
                <div>Frunze</div>
                <div>123 Mosk</div>
            </div>
            <div class="company-phone col-xs-12">
                <div>Тел.: +38 0432 25 25 25</div>
                <div>Мобильный: +38 123 999 88 77</div>
            </div>
            <div class="company-email col-xs-12">
                <div>E-mail: example@gmail.com</div>
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
                                <h1 class="pull-left">
                                    <i class="icon-edit"></i>
                                    <span>Wizard</span>
                                </h1>

                                <div class="pull-right">
                                    <ul class="breadcrumb">
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
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box">
                                <div class="box-content box-padding">
                                    <div class="fuelux">
                                        <div class="wizard">
                                            <ul class="steps">
                                                <li class="active" data-target="#step1">
                                                    <span class="step">1</span>
                                                </li>
                                                <li data-target="#step2">
                                                    <span class="step">2</span>
                                                </li>
                                            </ul>
                                            <div class="actions">
                                                <button class="btn btn-xs btn-prev"><i class="icon-arrow-left"></i>Prev
                                                </button>
                                                <button class="btn btn-xs btn-success btn-next" data-last="Finish">
                                                    Next
                                                    <i class="icon-arrow-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="step-content">
                                            <hr class="hr-normal">
                                            <form class="form" style="margin-bottom: 0;" method="post" action="#"
                                                  accept-charset="UTF-8"><input name="authenticity_token" type="hidden">

                                                <div class="step-pane active" id="step1">
                                                    <div class="form-group">

                                                        <div class="question">
                                                            <div class="col-xs-12">
                                                                <label class="control-label">Кто производитель вашего телефона?</label>
                                                            </div>
                                                            <div class="col-xs-11 col-xs-offset-1">
                                                                Выберите модель телефона:
                                                            </div>
                                                            <div class="col-xs-11 col-xs-offset-1">
                                                                <div class="form-group">
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">Nokia
                                                                        </label>
                                                                    </div>
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Samsung
                                                                        </label>
                                                                    </div>
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio" name="optionsRadios" id="optionsRadios3" value="option2">iPhone
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr class="hr-normal">


                                                        <div class="question">
                                                            <div class="col-xs-12">
                                                                <label class="control-label">Что случилось с вашим телефоном?</label>
                                                            </div>
                                                            <div class="col-xs-11 col-xs-offset-1">
                                                                Укажите что перестало работать в Вашем телефоне:
                                                            </div>
                                                            <div class="col-xs-11 col-xs-offset-1">
                                                                <div class="form-group">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" value="">
                                                                            Разбился екран
                                                                        </label>
                                                                        <i class="fa fa-question-circle small-ico">
                                                                            <div class="hint">
                                                                                Екран разбит и имеет много трещин
                                                                            </div>
                                                                        </i>
                                                                    </div>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" value="">
                                                                            Не работает динамик
                                                                        </label>
                                                                        <i class="fa fa-question-circle small-ico">
                                                                            <div class="hint">
                                                                                Я ничего не слышу когда мне звонят
                                                                            </div>
                                                                        </i>
                                                                    </div>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" value="">
                                                                            Не работает сенсор
                                                                        </label>
                                                                        <i class="fa fa-question-circle small-ico">
                                                                            <div class="hint">
                                                                                Сенсор не реагирует на нажатия
                                                                            </div>
                                                                        </i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr class="hr-normal">

                                                        <div class="question">
                                                            <div class="col-xs-12">
                                                                <label class="control-label">Как произошла поломка</label>
                                                            </div>
                                                            <div class="col-xs-11 col-xs-offset-1">
                                                                Укажите, что послужило причиной появления неисправности:
                                                            </div>
                                                            <div class="col-xs-11 col-xs-offset-1">
                                                                <div class="form-group">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" value="">
                                                                            Падение
                                                                        </label>
                                                                    </div>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" value="">
                                                                            Вода
                                                                        </label>
                                                                    </div>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" value="">
                                                                            Я не знаю
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="step-pane" id="step2">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label class="control-label" for="inputText">Имя</label>

                                                            <div class="controls">
                                                                <input class="form-control" id="inputText"
                                                                       placeholder="Text field" type="text">
                                                            </div>

                                                            <hr class="hr-normal">

                                                            <label class="control-label" for="inputText">Емейл</label>

                                                            <div class="controls">
                                                                <input class="form-control" id="inputText"
                                                                       placeholder="Text field" type="text">
                                                            </div>

                                                            <hr class="hr-normal">


                                                            <label class="control-label" for="inputText">Text field</label>

                                                            <div class="controls">
                                                                <input class="form-control" id="inputText"
                                                                       placeholder="Text field" type="text">
                                                            </div>

                                                            <hr class="hr-normal">


                                                            <label class="control-label" for="inputText">Text field</label>

                                                            <div class="controls">
                                                                <input class="form-control" id="inputText"
                                                                       placeholder="Text field" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        <div class="col-sm-6 buttons">
                            <a class="btn btn-link" href="http://www.bublinastudio.com/flatty">Preview</a>
                            <a class="btn btn-link"
                               href="https://wrapbootstrap.com/theme/flatty-flat-administration-template-WB0P6NR1N">Purchase</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </section>
</div>

<script src="http://www.bublinastudio.com/flattybs3/assets/javascripts/bootstrap/bootstrap.js"
        type="text/javascript"></script>
<!-- / theme file [required] -->
<script src="http://www.bublinastudio.com/flattybs3/assets/javascripts/theme.js" type="text/javascript"></script>

</body>
</html>