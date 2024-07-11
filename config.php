<?php

class loader {
    public static function Initialize() {    
        require_once 'util/medoo.php';
        require_once 'util/query.php';
        require_once 'util/util.php';
        require_once 'util/member.php';

        require_once 'util/enum.php';
        require_once 'util/security.php';
        require_once 'util/encrypt.php';
        require_once 'util/table.php';
    }
}

loader::Initialize();

@set_time_limit(600);

// set timezone to asia/bangkok
date_default_timezone_set('Asia/Bangkok');

ini_set('default_charset'        , 'UTF-8');

// [DATABASE ZONE]
define('DB_SERVER'               , '127.0.0.1');
define('DB_USERNAME'             , 'cosmic');
define('DB_PASSWORD'             , '123456');
define('DB_NAME'                 , 'users');
define('DB_PORT'                 , '3306');
define('DB_CHARSET'              , 'utf8');

// [GENERAL ZONE]
define('APP_TITLE'               , 'Member System');
define('MINIMUN_PASSWORD_LENGTH' , 6);
define('MAXIMUN_PASSWORD_LENGTH' , 24);
define('DOMAIN_SITE'             , 'localhost/member');

// [SECURITY ZONE]
define('ENCRYPT_KEY'             , 'memsyssecret');
define('ENCRYPT_SALT'            , 'salt50formemsys');

// [EXTRA]
define('ENABLE_HASH_PASSWORD'    , FALSE);

?>