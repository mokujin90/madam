<?php
?>
<html class=" js no-touch localstorage svg">
<head>
    <title>Termin: <?= Yii::t('main','регистрация')?> </title>
    <!-- / bootstrap [required] -->
    <link href="/css/bootstrap.css" media="all" rel="stylesheet" type="text/css">
    <!-- / theme file [required] -->
    <link href="/css/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet"
          type="text/css">
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="/css/theme-colors.css" media="all" rel="stylesheet" type="text/css">
    <!-- / demo file [not required!] -->
    <link href="/css/demo.css" media="all" rel="stylesheet" type="text/css">
    <style></style>
</head>
<body class="contrast-red login contrast-background">
<div class="middle-container">
    <div class="middle-row">
        <div class="middle-wrapper">
            <div class="login-container-header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <img width="121" src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="login-container">
                <?php echo $content; ?>
            </div>
            <div class="login-container-footer">
                <div class="container">
                    <?if($this->showRegisterLink):?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <a href="/user/register">
                                    <i class="icon-user"></i>
                                    <strong><?= Yii::t('main','Регистраци')?></strong>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?endif?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>