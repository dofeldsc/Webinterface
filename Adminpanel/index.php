<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');
$user = new User();
$rcon=new Rcon( '164.132.204.214', 'EcqRh4TAJck6Kv3307');
$DE100_GLOBALS['content'] = "dashboard";
$DE100_GLOBALS['title'] = "Dashboard - " .DE100_SITE_NAME;
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
