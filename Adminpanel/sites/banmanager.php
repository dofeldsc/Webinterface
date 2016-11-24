<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
$player = new Player();

if (Input::get('action')) {
    switch (Input::get('action')) {
        case 'unban':
            $player->unban(Input::get('banid'));
            break;
    }
    redirect(DIR_TO_SITES."banmanager.php");
}

$DE100_GLOBALS['content'] = "banmanager";
$DE100_GLOBALS['title'] = "Bans Verwalten - " .DE100_SITE_NAME;
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
