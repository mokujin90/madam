<!DOCTYPE html>
<html class=" js no-touch localstorage svg">
<head>
    <script src="http://www.bublinastudio.com/flattybs3/assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
    <!-- / bootstrap [required] -->
    <link href="/css/bootstrap.css" media="all" rel="stylesheet" type="text/css">
    <!-- / theme file [required] -->
    <link href="/css/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet"
          type="text/css">
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="/css/theme-colors.css" media="all" rel="stylesheet" type="text/css">
    <!-- / demo file [not required!] -->
    <link href="/css/demo.css" media="all" rel="stylesheet" type="text/css">
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
                        <a href="user_profile.html">
                            <i class="icon-user"></i>
                            Profile
                        </a>
                    </li>
                    <li>
                        <a href="user_profile.html">
                            <i class="icon-cog"></i>
                            Settings
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="sign_in.html">
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
                <form action="search_results.html" method="get">
                    <div class="search-wrapper">
                        <input value="" class="search-query form-control" placeholder="Search..." autocomplete="off" name="q"
                               type="text">
                        <button class="btn btn-link icon-search" name="button" type="submit"></button>
                    </div>
                </form>
            </div>
            <ul class="nav nav-stacked">
                <li class="">
                    <a href="/company">
                        <i class="icon-dashboard"></i>
                        <span>Company data</span>
                    </a>
                </li>

                <li class="">
                    <a href="/requestForm">
                        <i class="icon-star"></i>
                        <span>Date fields and date questions</span>
                    </a>
                </li>
                <li class="">
                    <a href="buttons_and_icons.html">
                        <i class="icon-star"></i>
                        <span>Online appointment booking</span>
                    </a>
                </li>

                <li>
                    <a class="dropdown-collapse <?=$this->mainMenuActiveId=='employee'?'in':'';?>" href="#">
                        <i class="icon-cogs"></i>
                        <span>Schedules</span>
                        <i class="icon-angle-down angle-down"></i>
                    </a>
                    <ul class="nav nav-stacked <?=$this->mainMenuActiveId=='employee'?'in':'';?>">
                        <li class="<?=empty($_GET['id'])?'active':'';?>">
                            <a href="/employee/create">
                                <i class="icon-plus"></i>
                                <span>Добавить работника</span>
                            </a>
                        </li>
                        <?foreach(User::getMenuList() as $item){?>
                        <li class="<?=(isset($_GET['id']) && $_GET['id']==$item->id)?'active':'';?>">
                            <a href="/employee/update/id/<?=$item->id;?>">
                                <i class="icon-user"></i>
                                <span><?=$item->login;?></span>
                            </a>
                        </li>
                        <?}?>
                    </ul>
                </li>
                <li class="">
                    <a href="tables.html">
                        <i class="icon-table"></i>
                        <span>Test online appointment booking</span>
                    </a>
                </li>
                <li class="">
                    <a href="calendar.html">
                        <i class="icon-calendar"></i>
                        <span>Calendar</span>
                    </a>
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
                                    <ul class="breadcrumb">
                                        <li>
                                            <a href="index.html">
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
                                    </ul>
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
<!-- / jquery [required] -->
<!-- / jquery mobile (for touch events) -->
<script src="http://www.bublinastudio.com/flattybs3/assets/javascripts/bootstrap/bootstrap.js"
        type="text/javascript"></script>
<!-- / theme file [required] -->
<script src="http://www.bublinastudio.com/flattybs3/assets/javascripts/theme.js" type="text/javascript"></script>
<!-- / demo file [not required!] -->
<!-- / START - page related files and scripts [optional] -->

<!-- / END - page related files and scripts [optional] -->

</body>
</html>