<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();

$DE100_GLOBALS['content'] = "profile";
$DE100_GLOBALS['title'] = "Benutzer - " .DE100_SITE_NAME;
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
