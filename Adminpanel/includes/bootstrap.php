<?php
/**
 * Created by PhpStorm.
 * User: moritzgebhardt
 * Date: 14.04.16
 * Time: 23:47
 *
 * Init File
 * Includes all classes and config
 */

// Config File
require_once(dirname(__FILE__) . '/config.php');

if (DEV_MODE) {
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
}

// Auto load classes
function __autoload($className) {
    if (file_exists(DIR_CLASSES . $className . '.php'))
        include DIR_CLASSES . $className . '.php';
}

$db = new DataBase(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
session_name("DE100_ACP");
ini_set('session.gc_maxlifetime', 7200);
session_set_cookie_params(7200);
session_start();
//require_once(DIR_FUNCTIONS . 'session.php');
require_once(DIR_INCLUDES . 'messages.php');
require_once(DIR_FUNCTIONS . 'general.php');


enqueue_javascript('jquery-2.2.3.min.js',false,false);
enqueue_javascript('bootstrap.min.js');
enqueue_javascript('moment.min.js');
enqueue_javascript('de.js');
enqueue_javascript('app.min.js');
enqueue_javascript('fastclick.min.js');
enqueue_javascript('jquery.slimscroll.min.js');
enqueue_javascript('icheck.min.js');
enqueue_javascript('Chart.min.js');
enqueue_javascript('jquery.dataTables.min.js');
enqueue_javascript('dataTables.bootstrap.min.js');
enqueue_javascript('bootstrap-datetimepicker.min.js');
enqueue_javascript('dataTables.responsive.min.js');
enqueue_javascript('responsive.bootstrap.min.js');
enqueue_javascript('sweetalert.min.js');
enqueue_javascript('bootstrap-switch.min.js');
enqueue_javascript('numeral.min.js');
enqueue_javascript('alertify.min.js');
enqueue_javascript('dataTables.select.min.js');
enqueue_javascript('jquery.plugin.min.js');
enqueue_javascript('jquery.countdown.min.js');
enqueue_javascript('jquery.countdown-de.js');

enqueue_stylesheet('bootstrap.min.css');
enqueue_stylesheet('ionicons.min.css');
enqueue_stylesheet('AdminLTE.min.css');
enqueue_stylesheet('skin-black.min.css');
enqueue_stylesheet('dataTables.bootstrap.min.css');
enqueue_stylesheet('bootstrap-datetimepicker.min.css');
enqueue_stylesheet('responsive.bootstrap.min.css');
enqueue_stylesheet('sweetalert.css');
enqueue_stylesheet('bootstrap-switch.min.css');
enqueue_stylesheet('alertify.min.css');
enqueue_stylesheet('alertify_bootstrap.min.css');
enqueue_stylesheet('select.dataTables.min.css');
enqueue_stylesheet('jquery.countdown.css');
enqueue_stylesheet('custom.css');