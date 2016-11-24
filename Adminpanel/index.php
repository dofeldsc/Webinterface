<?php
/**
 * Created by PhpStorm.
 * User: moritzgebhardt
 * Date: 14.04.16
 * Time: 23:44
 */
require(dirname(__FILE__) . '/includes/bootstrap.php');
$user = new User();
$DE100_GLOBALS['content'] = "dashboard";
$DE100_GLOBALS['title'] = "Dashboard - " .DE100_SITE_NAME;
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
