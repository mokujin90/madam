<!DOCTYPE html>
<html class=" js no-touch localstorage svg">
<head>
    <script src="/js/jquery.min.js" type="text/javascript"></script>
    <!-- / bootstrap [required] -->
    <link href="/css/bootstrap.css" media="all" rel="stylesheet" type="text/css">
    <!-- / theme file [required] -->
    <link href="/css/jquery.jgrowl.min.css" media="all" rel="stylesheet" type="text/css">
    <link href="/css/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet"
          type="text/css">
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="/css/theme-colors.css" media="all" rel="stylesheet" type="text/css">
    <!-- / demo file [not required!] -->
    <link href="/css/demo.css" media="all" rel="stylesheet" type="text/css">
    <title><?php echo isset($this->pageCaption) ? $this->pageCaption : Yii::app()->name; ?></title>
    <meta charset="utf-8">

    <?Yii::app()->clientScript->registerScriptFile('/js/bootstrap.js', CClientScript::POS_END);?>
    <?Yii::app()->clientScript->registerScriptFile('/js/theme.js', CClientScript::POS_END);?>
    <?Yii::app()->clientScript->registerScriptFile('/js/jquery.jgrowl.min.js', CClientScript::POS_END);?>
    <?Yii::app()->clientScript->registerScriptFile('/js/admin.js', CClientScript::POS_END);?>
</head>
<body class="contrast-red main-nav-opened">
<header>
    <nav class="navbar navbar-default">
        <a class="navbar-brand" href="/">
            <img style="margin-top: 5px;" height="30" class="logo" alt="Flatty"
                 src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png">
        </a>
        <ul class="nav">
            <li class="dropdown dark user-menu">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <img height="30" alt="Mila Kunis" src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png">
                    <span class="user-name">Mila Kunis</span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#">
                            <i class="icon-user"></i>
                            Profile
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-cog"></i>
                            Settings
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="/admin/logout">
                            <i class="icon-signout"></i>
                            Sign out
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<div id="wrapper">
    <div id="main-nav-bg"></div>
    <nav id="main-nav">
        <div class="navigation">
            <div class="search">
                <form action="#" method="get">
                    <div class="search-wrapper">
                        <input value="" class="search-query form-control" placeholder="Search..." autocomplete="off" name="q"
                               type="text">
                        <button class="btn btn-link icon-search" name="button" type="submit"></button>
                    </div>
                </form>
            </div>
            <ul class="nav nav-stacked">
                <li class="">
                    <?php echo CHtml::link('<i class="icon-cog"></i><span>Base License</span>',array('adminLicense/index'),array('class'=>$this->mainMenuActiveId=='baseLicense'?'in':''))?>
                </li>
                <li class="">
                    <?php echo CHtml::link('<i class="icon-cog"></i><span>Company</span>',array('adminCompany/index'),array('class'=>$this->mainMenuActiveId=='company'?'in':''))?>
                </li>
                <li class="">
                    <?php echo CHtml::link('<i class="icon-cog"></i><span>Approve</span>',array('adminCompany/approveList'),array('class'=>$this->mainMenuActiveId=='approve'?'in':''))?>
                </li>
            </ul>
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
                                    <i class="icon-<?=$this->pageIcon?>"></i>
                                    <span><?=$this->pageCaption?></span>
                                </h1>

                                <div class="pull-right">
                                    <!--ul class="breadcrumb">
                                        <li>
                                            <a href="#">
                                                <i class="icon-bar-chart"></i>
                                            </a>
                                        </li>
                                        <li class="separator">
                                            <i class="icon-angle-right"></i>
                                        </li>
                                        <li>Layouts</li>
                                        <li class="separator">
                                            <i class="icon-angle-right"></i>
                                        </li>
                                        <li class="active">Closed navigation</li>
                                    </ul-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo $content; ?>

                </div>
            </div>
            <footer id="footer">
                <div class="footer-wrapper">
                    <div class="row">
                        <div class="col-sm-6 text">
                            Copyright © 2013 Your Project Name
                        </div>
                        <div class="col-sm-6 buttons">

                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </section>
</div>

</body>
</html>