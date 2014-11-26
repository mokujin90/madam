<div id="price-page">
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
    <hr class="gray-black-line">
    <?
        $check=array('control_dialog','group_event','email_confirm','sms_confirm','email_reminder','sms_reminder','email_event','sms_event','caldav','email_help','phone_help');

        function getLicenseRow($std, $attr, $check = false)
        {
            $html = '<tr><td class="params">' . License::model()->getAttributeLabel($attr) . '</td>';
            foreach ($std as $license) {
                if($check){
                    $html .= '<td><h2>' . (empty($license->{$attr}) ? '-' : '+') . '</h2></td>';
                } else {
                    $html .= '<td><h3>' . $license->{$attr} . '</h3></td>';
                }
            }
            $html .= '</tr>';
            return $html;
        }
    ?>
    <div class="price-wrapper content-wrapper">
        <p>бесплатный тестовый период <b>30</b> дней</p>
        <table>
            <tr>
                <th class="params"></th>
                <th><h2>Free</th>
                <th><h2>Standart</th>
                <th><h2>Pro</th>
                <!--
                <?foreach ($stdLicense as $license):?>
                    <th><h2><?=$license->request_text?></h2></th>
                <?endforeach?>
                -->
            </tr>
            <?=getLicenseRow($stdLicense, 'question')?>
            <?=getLicenseRow($stdLicense, 'employee')?>
            <?=getLicenseRow($stdLicense, 'event')?>
            <?=getLicenseRow($stdLicense, 'sms')?>
            <?=getLicenseRow($stdLicense, 'max_sms')?>
            <?foreach($check as $field):?>
                <?=getLicenseRow($stdLicense, $field, true)?>
            <?endforeach;?>
        </table>
        <a class="btn-a" href="<?=$this->createUrl(Yii::app()->user->isGuest ? 'user/register' : 'company/more')?>"><button class="btn">Подобрать индивидуальный тариф</button></a>
    </div>
</div>
<script>
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