<?php
require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'local.php');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Termin',
     // requires you to copy the theme under your themes directory

    // preloading 'log' component
    'preload' => array('log'),
    'language' => 'ru',
    'timeZone' => 'Europe/Moscow',

    // autoloading model and component classes
    'import' => array(
        'application.controllers.*',
        'application.models.*',
        'application.models.form.*',
        'application.components.*',
        'application.helpers.*',
        'application.widgets.*',
        'zii.widgets.jui.*',
        'zii.widgets.grid.*',
        'application.extensions.JsTrans.*',
        'application.extensions.easyPaypal.*'
    ),

    // application components
    'components' => array(
        'db' => $db_connection_array,
        'db_baikal' => $db_connection_array_baikal,
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),

        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'ImageMagick',
            // ImageMagick setup path
            // 'params'=>array('directory'=>'/opt/local/bin'),
        ),
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
        ),

        'urlManager' => array(
            'showScriptName' => false,
            'urlFormat' => 'path',
            'caseSensitive' => 'false',
            'rules' => array(
                'gii' => 'gii',
                'gii/<controller:nw+>' => 'gii/<controller>',
                'gii/<controller:nw+>/<action:nw+>' => 'gii/<controller>/<action>',

                '/'=>'site/index',
                '/employee/create/'=>'/employee/update/',
            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        'host' => preg_replace('/:\d+$/', '', preg_replace('/^www\./', '', $_SERVER["HTTP_HOST"])),
        'cookieDomain' => '.' . preg_replace('/:\d+$/', '', preg_replace('/^www\./', '', $_SERVER["HTTP_HOST"])),

        'adminEmail' => $adminEmail,
        'fromEmail' => "termin@wconsults.ru",
        'fromName' => 'Termin',

        'PAYPAL_API_USERNAME'=>'multik_api1.nxt.ru',
        'PAYPAL_API_PASSWORD'=>'QS8V2APJLXQ5KT2R',
        'PAYPAL_API_SIGNATURE'=>'A78A4fsFXicJRsDsyZvdKFFiCjcJA5kyvDfy9YtcklE0L.sW7qsg20sG',
        'PAYPAL_MODE'=>'sandbox',   // sandbox/live  default=sandbox

        'SOFORT_CONFIG_KEY' => '',

        'SK_CLIENT_ID' => '',
        'SK_PDF_TAMPLATE_ID' => 'booBrsn0ur5lX-uLqadCK_',
        'SK_EMAIL_TAMPLATE_ID' => 'boqgAYn0ur5lX-uLqadCK_',
        'SK_DOMAIN' => 'wconsults',
        'SK_USER' => '',
        'SK_PASS' => '',

    ),
);
