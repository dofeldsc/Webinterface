<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
$player = new Player(Player::PIDtoUID($user->steamID()));
if (!$user->isLoggedIn()) {
	redirect(DE100_DOMAIN,"Du bist nicht eingeloggt",MSG_TYPE_ERROR);
}
if (!$player->data()) {
    redirect(DE100_DOMAIN,"Es ist ein Fehler aufgetreten",MSG_TYPE_ERROR);
}

$msg = $user->retrieveArticle();
if (is_array($msg)) {
    foreach ($msg as $n) {
        add_notify($n[0],$n[1],-1);
    }
}

$DE100_GLOBALS['content'] = "inventory";
$DE100_GLOBALS['title'] = "Online-Inventar - " .DE100_SITE_NAME;
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>