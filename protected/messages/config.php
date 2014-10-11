<?php
/**
 * This is the configuration for generating message translations
 * for the Yii framework. It is used by the 'yiic message' command.
 */
return array(
    'sourcePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'../..',
    'messagePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'messages',
    'languages'=>array('en_US','de'),
    'fileTypes'=>array('php'),
    'overwrite'=>true,
    'sort' => false,
    'exclude'=>array(
        '.git',
        'yiilite.php',
        'yiit.php',
        '/protected/gii',
        '/protected/messages',
        '/images',
        '/css',
        '/js',
        '/stylesheets',
        '/themes',
        '/assets',
        '/protected/assets',
    ),
);