<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();

$DE100_GLOBALS['content'] = "logs";
$DE100_GLOBALS['title'] = "Logs - " .DE100_SITE_NAME;
$DE100_GLOBALS['permission'] = "LogsView";
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");

