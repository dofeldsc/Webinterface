<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();

if (!$user->isLoggedIn()) {
	redirect(DE100_DOMAIN,"Du bist nicht eingeloggt",MSG_TYPE_ERROR);
}

$DE100_GLOBALS['content'] = "notifications";
$DE100_GLOBALS['title'] = "Benachrichtigungen - " .DE100_SITE_NAME;
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>