<?php

// Site name
if (!defined('DE100_SITE_VERSION'))
    define('DE100_SITE_VERSION', '0.1.1');


// If true show errors
if (!defined('DEV_MODE'))
    define('DEV_MODE', true);

// Site url
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'http://';
}

if (!defined('DE100_DOMAIN'))
    define('DE100_DOMAIN',$uri . $_SERVER['HTTP_HOST'] . '/acp/');

// Site name
if (!defined('DE100_SITE_NAME'))
    define('DE100_SITE_NAME', 'DE100');

// Site root path
if (!defined('DIR_ROOT'))
    define('DIR_ROOT', dirname(dirname(__FILE__)) . '/');

// Include path
if (!defined('DIR_INCLUDES'))
    define('DIR_INCLUDES', DIR_ROOT . 'includes/');

// DB config file
require_once(DIR_INCLUDES . 'db_config.php');

// Classes path
if (!defined('DIR_CLASSES'))
    define('DIR_CLASSES', DIR_INCLUDES . 'classes/');

if (!defined('DIR_IMGS'))
    define('DIR_IMGS', DIR_ROOT . 'assets/img/');

// Functions path
if (!defined('DIR_FUNCTIONS'))
    define('DIR_FUNCTIONS', DIR_INCLUDES . 'functions/');

if (!defined('SESSION_NAME'))
    define('SESSION_NAME', '_DE100_SSESSID');
    
if (!defined('DIR_TEMPLATES'))
    define('DIR_TEMPLATES', DIR_ROOT . "templates/");

if (!defined('DIR_SITES'))
    define('DIR_SITES', DIR_ROOT . "sites/");

if (!defined('DIR_TO_JS'))
    define('DIR_TO_JS', DE100_DOMAIN.'assets/js/');

if (!defined('DIR_TO_CSS'))
    define('DIR_TO_CSS', DE100_DOMAIN.'assets/css/');

if (!defined('DIR_TO_IMG'))
    define('DIR_TO_IMG', DE100_DOMAIN.'assets/img/');

if (!defined('DIR_TO_SITES'))
    define('DIR_TO_SITES', DE100_DOMAIN.'sites/');
    
if (!defined('DIR_TO_HOOKS'))
    define('DIR_TO_HOOKS', DE100_DOMAIN.'hooks/');


// Message Types
if (!defined('MSG_TYPE_SUCCESS'))
    define('MSG_TYPE_SUCCESS', 1);

if (!defined('MSG_TYPE_ERROR'))
    define('MSG_TYPE_ERROR', 0);
    
    
// User Roles
if (!defined('USER_ROLE_STUDENT'))
    define('USER_ROLE_STUDENT', 1);
    
if (!defined('USER_ROLE_MOD'))
    define('USER_ROLE_MOD', 2);

if (!defined('USER_ROLE_ADMIN'))
    define('USER_ROLE_ADMIN', 3);


if (!defined('STEAMAPIKEY'))
    define('STEAMAPIKEY', "6C958B11A361DF9AF3EF4EDB01588BCB");

// Login
define('MAX_LOGIN_ATTEMPT', 5);
define('MAX_LOGIN_ATTEMPT_PERIOD', 15 * 60); // 15 min

//Arma3 Data
require_once(DIR_INCLUDES . 'arma_config.php');

//Rechte
require_once(DIR_INCLUDES . 'permissions.php');

//logs
require_once(DIR_INCLUDES . 'logs.php');

$DE100_GLOBALS = [
    'layout' => 'layout',
    'permission' => 'permission',
    'stylesheets' => [],
    'javascripts' => [],
    'phpscripts' => []
];