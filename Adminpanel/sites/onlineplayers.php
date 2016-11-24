<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
$player = new Player();
$rcon = new Rcon('164.132.204.214', 'EcqRh4TAJck6Kv3307');
if (Input::get('action')) {
    switch(Input::get('action')){
        case 'kick':
            //Permmision CHECK!! SINCE YOU CAN HACK THIS!
            if (!$user->hasPermision("BanKick")) {
                redirect(DE100_DOMAIN,"Was hast du den da Versucht ?",MSG_TYPE_ERROR);
            }
            $rcon->kickPlayer(Input::get('id'),'Gekickt von ' . $user->username() . ' Grund: ' . Input::get('reason'));
            add_message("Spieler ". Input::get('name') ." wurde gekickt", MSG_TYPE_SUCCESS);
            break;
        case 'tmpban':
            //Permmision CHECK!! SINCE YOU CAN HACK THIS!
            if (!$user->hasPermision("BanTmp")) {
                redirect(DE100_DOMAIN,"Was hast du den da Versucht ?",MSG_TYPE_ERROR);
            }
            $player->addBan(Input::get('guid'),Input::get('rconid'),Input::get('name'),$user->username(),Input::get('date'),Input::get('reason'));
            add_message("Spieler ". Input::get('name') ." wurde temporär gebannt.", MSG_TYPE_SUCCESS);
            break;
        case 'ban':
            //Permmision CHECK!! SINCE YOU CAN HACK THIS!
            if (!$user->hasPermision("BanPerm")) {
                redirect(DE100_DOMAIN,"Was hast du den da Versucht ?",MSG_TYPE_ERROR);
            }
            $player->addBan(Input::get('guid'),Input::get('rconid'),Input::get('name'),$user->username(),Input::get('date'),Input::get('reason'));
            add_message("Spieler ". Input::get('name') ." wurde permanent gebannt.", MSG_TYPE_SUCCESS);
            break;
    }
    redirect(DIR_TO_SITES."onlineplayers.php");
}

$DE100_GLOBALS['content'] = "onlineplayers";
$DE100_GLOBALS['title'] = "Online Spieler - " .DE100_SITE_NAME;
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
