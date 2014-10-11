<?php
return array(
    'sourcePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'../..',
    'messagePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'messages',
    'translator' => 'Yii.t',
    'languages'=>array('en_US','de'),
    'fileTypes' => array('js'),
    'overwrite' => true,
    'sort' => false,
    'exclude' => array(
        '.git',
        '.svn',
        '/framework',
        '/protected',
    ),
);