<?php
define('YII_DEBUG', true);

$adminEmail = 'example@example.com';

$local_db['name'] = "termin";
$local_db['host'] = '127.0.0.1';
$local_db['username'] = 'root';
$local_db['password'] = '';

$db_connection_array = array(
    'class' => 'CDbConnection',
    'connectionString' => "mysql:host={$local_db['host']};dbname={$local_db['name']}",
    'username' => $local_db['username'],
    'password' => $local_db['password'],
    'charset' => 'utf8',
    /*'enableProfiling'=>true,*/
    'enableParamLogging' => true,
    /*'schemaCachingDuration'=>3600,*/
);
$db_connection_array_baikal = array(
    'class' => 'CDbConnection',
    'connectionString' => "mysql:host={$local_db['host']};dbname=baikal",
    'username' => $local_db['username'],
    'password' => $local_db['password'],
    'charset' => 'utf8',
    /*'enableProfiling'=>true,*/
    'enableParamLogging' => true,
    /*'schemaCachingDuration'=>3600,*/
);

$log_develop_category = array(
    'class' => 'CFileLogRoute',
    'levels' => 'trace',
    'categories' => 'develop',
);

$log_sql_disabled = array(
    'class' => 'CFileLogRoute',
    'categories' => 'system.db.*'
);

$log_email_disabled = array(
    'class' => 'ExtEmailLogRoute',
    'levels' => 'error, warning',
    'filter' => array('class' => 'CategoryExcludeLogFilter',
                      'categories' => array('exception.CHttpException.404', 'exception.CHttpException.403')),
    'emails' => $adminEmail,
    'subject' => 'error, warning'
);

$gii = array(
    'class' => 'system.gii.GiiModule',
    'password' => '123',
    'ipFilters' => array('127.0.0.1'),
);
