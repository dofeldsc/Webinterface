<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
$player = new Player();

$DE100_GLOBALS['content'] = "players";
$DE100_GLOBALS['title'] = "Spieler - " .DE100_SITE_NAME;
$DE100_GLOBALS['permission'] = "PlayersView";
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
