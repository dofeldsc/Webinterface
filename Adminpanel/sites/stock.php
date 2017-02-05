<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
$stock = new Stock();

$DE100_GLOBALS['content'] = "stock";
$DE100_GLOBALS['title'] = "Börse - " .DE100_SITE_NAME;
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");