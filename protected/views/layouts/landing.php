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
    Yii::app()->clientScript->registerCssFile('/css/jquery.fancybox.css');

    Yii::app()->clientScript->registerScriptFile('/js/jquery.min.js', CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.bxslider.min.js', CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile('/js/jquery.fancybox.pack.js', CClientScript::POS_END);
    ?>
</head>
<body>
    <header>
        <div class="header-wrapper">
            <a href="/" class="logo-wrapper"><span class="dark">termix</span><span class="light">expert</span> </a>
            <div class="top-menu">
                <div class="main-menu">
                    <?=CHtml::link('Главная', $this->createUrl('site/index'), array('class' => $this->menuItem == 'index' ? 'active' : ''))?>
                    <?=CHtml::link('Цены', $this->createUrl('site/price'), array('class' => $this->menuItem == 'price' ? 'active' : ''))?>
                    <?=CHtml::link('Направления', $this->createUrl('site/apport'), array('class' => $this->menuItem == 'apport' ? 'active' : ''))?>
                </div>
                <div class="user-menu">
                    <?if(Yii::app()->user->isGuest):?>
                        <?=CHtml::link('Вход','#auth-content',array('class'=>'auth-fancy'))?>
                        <?=CHtml::link('Регистрация', $this->createUrl('user/register'), array('class' => $this->menuItem == 'register' ? 'active' : ''))?>
                    <?else:?>
                        <?=CHtml::link('Управление', $this->userUrlByRole())?>
                    <?endif?>
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
                    <?=CHtml::link('Главная', $this->createUrl('site/index'), array('class' => $this->menuItem == 'index' ? 'active' : ''))?>
                </div>
                <div class="footer-menu-item">
                    <?=CHtml::link('Цены', $this->createUrl('site/price'), array('class' => $this->menuItem == 'price' ? 'active' : ''))?>
                </div>
                <div class="footer-menu-item">
                    <?=CHtml::link('Направления', $this->createUrl('site/apport'), array('class' => $this->menuItem == 'apport' ? 'active' : ''))?>
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
    <div class="hidden" id="auth-content">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>'/user/login',
            'htmlOptions'=>array(
                'class'=>'auth-form'
            )
        )); ?>
        <div class="row">
            <?php echo CHtml::textField('LoginForm[username]','',array('class' => 'form-input', 'placeholder'=>Yii::t('main','Логин')))?>
            <div class="errorMessage" id="LoginForm_username_em_" style="display: none;"></div>
        </div>
        <div class="row">
            <?php echo CHtml::passwordField('LoginForm[password]','',array('class' => 'form-input', 'placeholder'=>Yii::t('main','Пароль')))?>
            <div class="errorMessage" id="LoginForm_password_em_" style="display: none;"></div>
        </div>
        <div class="data">
            <?php echo CHtml::checkBox('LoginForm[rememberMe]',true,array('id'=>'login_forget_me'))?>
            <?php echo CHtml::label(Yii::t('main','Запомнить меня'),'login_forget_me')?>
        </div>
        <div class="data">
            <?php echo
            CHtml::ajaxSubmitButton('Войти',CHtml::normalizeUrl(array('user/login')),
                array(
                    'dataType'=>'json',
                    'type'=>'post',
                    'success'=>'function(data)
                        {
                            var $form = $(".auth-form");
                            $form.find(".errorMessage").hide();
                            if(data.error!="[]"){
                                var error = $.parseJSON(data.error);
                                $.each(error, function(key, val) {
                                    $form.find("#"+key+"_em_").text(val).show();
                                });
                            }
                            else if(data.status==true){
                                location.href=data.url;
                            }
                        }'
                ),array('class' => 'btn','id' => 'login-action'));
            ?>
            <?php // echo CHtml::link(Yii::t('main','Зарегистрироваться'),array('user/registerForm'),array('class'=>'fancybox.ajax dash register'))?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
    <script>
        $(function(){
            $('.auth-fancy').fancybox(
                {
                fitToView: false,
                autoSize:false,
                scrolling:'no',
                closeBtn:true,
                beforeLoad:function(){
                    $(document).on('click.fancybox','.close-fancy',function(){
                        $.fancybox.close()
                    });
                },
                title:'',
                width:355,
                height:'auto'
            });
        })
    </script>
</body>
</html>