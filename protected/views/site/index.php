<div id="index-page">
    <div class="register-overlay">
        <div class="register-wrapper content-wrapper">
            <div class="register-opacity-text">
                Ermöglichen Sie Ihren Kunden, Termine online zu buchen. Sparen Sie Zeit am Telefon und konzentrieren Sie sich auf Ihr Kerngeschäft.
                <br><br>
                Erschließen Sie neue Wege, Neukunden zu gewinnen und binden Sie Ihre bestehende Kunden noch stärker an Sie.
            </div>
            <div class="register-opacity-form">
                <form action="user/register" method="post">
                    <?=CHtml::textField('User[login]', '', array('class'=>"form-input", 'placeholder' =>Yii::t('main','Email')))?>
                    <?=CHtml::passwordField('User[password]', '', array('class'=>"form-input", 'placeholder' =>Yii::t('main','Пароль')))?>
                    <?=CHtml::passwordField('User[password_repeat]', '', array('class'=>"form-input", 'placeholder' =>Yii::t('main','Пароль повторно')))?>
                    <input type="submit" name="shortForm" class="btn" value="Kostenlos anmelden">
                </form>
                <div class="register-about">
                    <!--div class="register-about-text">Преимущества регистрации прямо сейчас:</div-->
                    <div class="register-about-item test-icon">Überzeugen Sie sich selbst und kostenlos während der 30-tägigen Test Periode</div>
                    <div class="register-about-item user-icon">Alle Funktionen stehen  Ihnen während der Testphase im vollem Umfang zur Verfügung</div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-wrapper content-wrapper">
        <div class="about-item global">
            <div class="about-item-title">Immer erreichbar</div>
            <div class="about-item-text">Vergeben Sie Ihre Termine 24 Stunden am Tag, 365 Tage im Jahr ganz ohne Personalaufwand.</div>
        </div>
        <div class="about-item phone">
            <div class="about-item-title">Kostengünstig</div>
            <div class="about-item-text">Bereits ab 49 Cent am Tag steht Ihren Kunden ein  professionelles lestungsfähiges  Terminbuschungssystem zur Verfügung.</div>
        </div>
        <div class="about-item comm">
            <div class="about-item-title">Zeitgemäß</div>
            <div class="about-item-text">Lassen Sie Ihr Unternehmen (Geschäft) zeitgemäß auftretten. Für Know-How sorgen wir, Sie konzentrieren sich auf Ihre Kunden.</div>
        </div>
    </div>
    <div class="stats-wrapper content-wrapper">
        <h2>Wichtige Zahlen</h2>
        <div class="stats-row">
            <span class="first-cell">bis <b>60%</b> Zeitersparnis durch wenige Telefonate</span>
            <span></span>
        </div>
        <div class="stats-row">
            <span class="first-cell"><b>95%</b> Personalkostenersparnis für die Terminvergabe</span>
            <span></span>
        </div>
        <div class="stats-row">
            <span class="first-cell"><b>100%</b> Kundenzufriedenheit</span>
            <span></span>
        </div>
    </div>
    <div class="index-slider-wrapper content-wrapper">
        <h2>Einfache Bedienbarkeit</h2>
        <div id="index-slider">
            <ul class="bxslider">
                <li><?php echo CHtml::image('/images/apport-img-1.jpg')?></li>
                <li><?php echo CHtml::image('/images/apport-img-2.jpg')?></li>
                <li><?php echo CHtml::image('/images/apport-img-3.jpg')?></li>
            </ul>
        </div>
    </div>
    <div class="functions-wrapper content-wrapper">
        <h2>Funktionen</h2>
        <div class="function-item">
            <div class="function-item-number">1</div>
            <div class="function-item-text">Direkte Terminbuchung über Ihre Homepage und Ihre Facebook Widget.</div>
        </div>
        <div class="function-item">
            <div class="function-item-number">2</div>
            <div class="function-item-text">SMS - und E-Mail - Bestätigung/Erinnerung für Ihre Kunden.</div>
        </div>
        <div class="function-item last">
            <div class="function-item-number">3</div>
            <div class="function-item-text">Kontroll Dialog - Terminanfragen werden in Abhängigkeit voneinander gestellt, sodass Terminwünsche optimal definiert werden.</div>
        </div>
        <div class="clear"></div>
        <div class="function-item">
            <div class="function-item-number">4</div>
            <div class="function-item-text">Optimiert für alle Smartphones und Tablets.</div>
        </div>
        <div class="function-item">
            <div class="function-item-number">5</div>
            <div class="function-item-text">Gruppentermine für Seminare und Veranstaltungen.</div>
        </div>
        <div class="function-item last">
            <div class="function-item-number">6</div>
            <div class="function-item-text">Soft Skills Verwaltung der Mitarbeiter. Termine werden automatisch an den Mitarbeiter zugewiesen, der für diese Terminart geeignet ist.</div>
        </div>
        <div class="clear"></div>
        <!--a class="function-more" href="<?=$this->createUrl('site/more')?>">Mehr...</a-->
    </div>
    <!--hr class="gray-black-line">
    <div class="team-wrapper content-wrapper">
        <h2>Unseres Team</h2>
        <div class="sub-title">ausgeblendet</div>
        <div class="team-item">
            <div class="team-item-avatar">
                <img src="http://www.joomlaworks.net/images/demos/galleries/abstract/5.jpg" >
            </div>
            <div class="team-item-name">Имя Фамилия</div>
            <div class="team-item-post">Должность</div>
            <div class="team-item-social">
                <a href="#" class="twitter"></a>
                <a href="#" class="fb"></a>
                <a href="#" class="skype"></a>
            </div>
        </div>
        <div class="team-item">
            <div class="team-item-avatar">
                <img src="http://www.joomlaworks.net/images/demos/galleries/abstract/6.jpg" >
            </div>
            <div class="team-item-name">Имя Фамилия</div>
            <div class="team-item-post">Должность</div>
            <div class="team-item-social">
                <a href="#" class="twitter"></a>
                <a href="#" class="fb"></a>
                <a href="#" class="skype"></a>
            </div>
        </div>
        <div class="team-item">
            <div class="team-item-avatar">
                <img src="http://www.joomlaworks.net/images/demos/galleries/abstract/9.jpg" >
            </div>
            <div class="team-item-name">Имя Фамилия</div>
            <div class="team-item-post">Должность</div>
            <div class="team-item-social">
                <a href="#" class="twitter"></a>
                <a href="#" class="fb"></a>
                <a href="#" class="skype"></a>
            </div>
        </div>
    </div>
    <hr class="gray-black-line"-->
    <div class="comment-wrapper content-wrapper">
        <h2>Kunderezensionen</h2>
        <div id="comment-slider">
            <ul class="comment-bxslider">
                <li>
                    <div class="comment-slide">
                        <img src="http://www.joomlaworks.net/images/demos/galleries/abstract/6.jpg" class="avatar">
                        <div class="text">„Stuttgart Phone“  - Durch Einsatz von termin-expert.de haben wir unsere Prozesse optimiert. Kunden freuen sich auf zusätzliche Möglichkeit, Termine online zu buchen...</div>
                        <div class="name">Имя / Ник</div>
                        <div class="post">Должность</div>
                    </div>
                </li>
                <li>
                    <div class="comment-slide">
                        <img src="http://www.joomlaworks.net/images/demos/galleries/abstract/6.jpg" class="avatar">
                        <div class="text">„Stuttgart Phone“  - Durch Einsatz von termin-expert.de haben wir unsere Prozesse optimiert. Kunden freuen sich auf zusätzliche Möglichkeit, Termine online zu buchen...</div>
                        <div class="name">Имя / Ник</div>
                        <div class="post">Должность</div>
                    </div>
                </li>
                <li>
                    <div class="comment-slide">
                        <img src="http://www.joomlaworks.net/images/demos/galleries/abstract/9.jpg" class="avatar">
                        <div class="text">Stuttgart Phone“ - Durch Einsatz von termin-expert.de haben wir unsere Prozesse optimiert. Kunden freuen sich auf zusätzliche Möglichkeit, Termine online zu buchen...„Stuttgart Phone“  - Durch Einsatz von termin-expert.de haben wir unsere Prozesse optimiert. Kunden freuen sich auf zusätzliche Möglichkeit, Termine online zu buchen...</div>
                        <div class="name">Имя / Ник</div>
                        <div class="post">Должность</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
    $('.bxslider').bxSlider({
        minSlides: 1,
        maxSlides: 1,
        slideWidth: 1000,
        slideHeight: 480,
        slideMargin: 10,
        useCSS:true,
        pager:false,
        infiniteLoop: false,
        hideControlOnEnd: true
    });
    $('.comment-bxslider').bxSlider({
        minSlides: 1,
        maxSlides: 1,
        slideWidth: 1000,
        slideMargin: 10,
        useCSS:true,
        infiniteLoop: false,
        hideControlOnEnd: true
    });
</script>