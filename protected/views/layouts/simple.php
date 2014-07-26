<?php
/**
 * @var $this SiteController
 * @var $company Company
 * @var &question Question
 */
?>
<html class=" js no-touch localstorage svg">
<head>
    <script src="/js/jquery.min.js" type="text/javascript"></script>

    <?Yii::app()->clientScript->registerScriptFile('/js/bootstrap.js', CClientScript::POS_END);?>
    <?Yii::app()->clientScript->registerScriptFile('/js/theme.js', CClientScript::POS_END);?>
    <?Yii::app()->clientScript->registerScriptFile('/js/wizard.js', CClientScript::POS_END);?>

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

    <?php echo $content; ?>


</div>

</body>
</html>
