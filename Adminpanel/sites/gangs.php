<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();

$gang = new Gang();

$DE100_GLOBALS['content'] = "gangs";
$DE100_GLOBALS['title'] = "Gangs - " .DE100_SITE_NAME;
$DE100_GLOBALS['permission'] = "GangsView";
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");

