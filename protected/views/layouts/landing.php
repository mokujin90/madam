<?
/**
 * @var $this SiteController
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($this->pageCaption) ? $this->pageCaption : Yii::app()->name; ?></title>
    <meta charset="utf-8">
    <?
    Yii::app()->clientScript->registerCssFile('/css/normalize.css');
    Yii::app()->clientScript->registerCssFile('/css/landing.css');
    Yii::app()->clientScript->registerCssFile('/css/vendor/jquery.bxslider.css');

    Yii::app()->clientScript->registerScriptFile('/js/jquery.min.js', CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.bxslider.min.js', CClientScript::POS_HEAD);
    ?>
</head>
<body>
    <header>
        <div class="header-wrapper">
            <a href="/" class="logo-wrapper"><span class="dark">termix</span><span class="light">expert</span> </a>
            <div class="top-menu">
                <div class="main-menu">
                    <?=CHtml::link('Главная', $this->createUrl('site/index'))?>
                    <?=CHtml::link('Цены', $this->createUrl('site/price'))?>
                    <?=CHtml::link('Направления', $this->createUrl('site/apport'))?>
                </div>
                <div class="user-menu">
                    <?=CHtml::link('Вход', $this->createUrl('user/login'))?>
                    <a href="#">Регистрация</a>
                </div>
            </div>
            <a href="#" class="ios-app">
                <b>IOS</b><br><span>application<br><b>free</b></span>
            </a>
            <!--div class="header-text">Онлайн бронирование для вашего бизнеса</div-->
            <div class="header-text">Book online for your business</div>
        </div>
    </header>
    <div class="content">
        <?php echo $content; ?>
    </div>
    <div class="request-wrapper">
        <div class="content-wrapper">
            <h2>Cdelaite zayavky</h2>
            <form class="request-form">
                <input type="text" value="Ввод текста пример" class="form-input">
                <input type="text" value="Ввод текста пример" class="form-input">
                <input type="text" value="Ввод текста пример" class="form-input">
                <input type="submit" class="btn" value="Регистрация">
            </form>
        </div>
    </div>
    <footer>
        <div class="footer-wrapper">
            <div class="footer-menu">
                <div class="footer-menu-item">
                    <a href="#">Главная</a>
                </div>
                <div class="footer-menu-item">
                    <a href="#">Цены</a>
                </div>
                <div class="footer-menu-item">
                    <a href="#">Направления</a>
                    <ul class="footer-submenu">
                        <li><a href="#">Цены</a></li>
                        <li><a href="#">Цены</a></li>
                        <li><a href="#">Цены</a></li>
                        <li><a href="#">Цены</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-data">
                <div class="copyright">2014, termin-expert.ru</div>
                <div class="social">
                    <a href="#" class="twitter"></a>
                    <a href="#" class="fb"></a>
                    <a href="#" class="skype"></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>