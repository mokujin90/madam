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


    <?Yii::app()->clientScript->registerScriptFile('/js/bootstrap.js', CClientScript::POS_END);?>
    <?Yii::app()->clientScript->registerScriptFile('/js/theme.js', CClientScript::POS_END);?>
    <?Yii::app()->clientScript->registerScriptFile('/js/jquery.jgrowl.min.js', CClientScript::POS_END);?>
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
                        <a href="/user/logout">
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
                <?if(Yii::app()->user->owner):?>
                <li class="">
                    <a href="/company"  class="<?=$this->mainMenuActiveId=='company'?'in':'';?>">
                        <i class="icon-cog"></i>
                        <span>Company data</span>
                    </a>
                </li>

                <li class="">
                    <a href="/company/settings"  class="<?=$this->mainMenuActiveId=='settings'?'in':'';?>">
                        <i class="icon-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>

                <li class="">
                    <a href="/requestForm" class="<?=$this->mainMenuActiveId=='question'?'in':'';?>">
                        <i class="icon-question"></i>
                        <span>Date fields and date questions</span>
                    </a>
                </li>

                <li>
                    <a class="dropdown-collapse <?=$this->mainMenuActiveId=='employee'?'in':'';?>" href="#">
                        <i class="icon-group"></i>
                        <span>Employees</span>
                        <i class="icon-angle-down angle-down"></i>
                    </a>
                    <ul class="nav nav-stacked <?=$this->mainMenuActiveId=='employee'?'in':'';?>">
                        <li class="<?=empty($_GET['id']) && $this->mainMenuActiveId=='employee' ?'active':'';?>">
                            <a href="/employee/create">
                                <i class="icon-plus"></i>
                                <span>Добавить работника</span>
                            </a>
                        </li>
                        <?foreach(User::getMenuList() as $item){?>
                        <li class="<?=$this->mainMenuActiveId=='employee' && (isset($_GET['id']) && $_GET['id']==$item->id)?'active':'';?>">
                            <a href="/employee/update/id/<?=$item->id;?>">
                                <i class="icon-user"></i>
                                <span><?=$item->login;?></span>
                            </a>
                        </li>
                        <?}?>
                    </ul>
                </li>
                <li class="">
                    <a href="/site/company/id/1" target="_blank">
                        <i class="icon-table"></i>
                        <span>Test online booking</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-collapse <?=$this->mainMenuActiveId=='calendar'?'in':'';?>" href="#">
                        <i class="icon-calendar"></i>
                        <span>Calendar</span>
                        <i class="icon-angle-down angle-down"></i>
                    </a>
                    <ul class="nav nav-stacked <?=$this->mainMenuActiveId=='calendar'?'in':'';?>">
                        <?foreach(User::getMenuList() as $item){?>
                        <li class="<?=($this->mainMenuActiveId=='calendar' && isset($_GET['id']) && $_GET['id']==$item->id)?'active':'';?>">
                            <a href="/calendar/index/id/<?=$item->id;?>">
                                <i class="icon-user"></i>
                                <span><?=$item->login;?></span>
                            </a>
                        </li>
                        <?}?>
                    </ul>
                </li>
                <li class="">
                    <a href="/company/more"  class="<?=$this->mainMenuActiveId=='more'?'in':'';?>">
                        <i class="icon-shopping-cart"></i>
                        <span>License</span>
                    </a>
                </li>
                <?else:?>
                    <li class="">
                        <a href="/site/company/id/1" target="_blank">
                            <i class="icon-table"></i>
                            <span>Test online booking</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="/calendar/index/id/<?=Yii::app()->user->id;?>" class="<?=$this->mainMenuActiveId=='calendar'?'in':'';?>">
                            <i class="icon-calendar"></i>
                            <span>Calendar</span>
                        </a>
                    </li>
                <?endif?>

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
                            <?if(Company::isBlock()):?>
                            <div class="alert alert-danger alert-dismissable">
                                <h4>
                                    <i class="icon-lock"></i>
                                    <?=Yii::t('main','Блокировка')?>
                                </h4>
                                <?=Yii::t('main','Возможность создавать/редактировать события заблокирована.')?>
                            </div>
                            <?endif?>
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