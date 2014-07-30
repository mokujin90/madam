<?php
require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'local.php');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'PROJECT_NAME',

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
    ),

    // application components
    'components' => array(
        'db' => $db_connection_array,
        /*
        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'ImageMagick',
            // ImageMagick setup path
            // 'params'=>array('directory'=>'/opt/local/bin'),
        ),
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
        ),*/

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
        'fromEmail' => 'robot@example.com',
        'fromName' => 'PROJECT_NAME',
    ),
);
