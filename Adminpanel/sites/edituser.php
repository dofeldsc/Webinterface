<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
$target = new User(Input::get('id'));

$DE100_GLOBALS['content'] = "edituser";
$DE100_GLOBALS['title'] = "Benutzer - " .DE100_SITE_NAME;
$DE100_GLOBALS['permission'] = "UserEdit";
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
