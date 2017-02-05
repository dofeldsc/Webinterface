<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
$player = new Player();
$ban = new Ban();
$rcon = new Rcon('164.132.204.214', 'EcqRh4TAJck6Kv3307');

if (Input::get('action')) {
    switch(Input::get('action')){
        case 'kick':
            if (!$user->hasPermision("BanKick")) {
                redirect(DE100_DOMAIN,"Dafür hast du nicht die Berechtigung",MSG_TYPE_ERROR);
            }
            $rcon->kickPlayer(Input::get('id'),'Gekickt von ' . $user->username() . '. Grund: ' . Input::get('reason'));
            $uid = $player->BEtoUID(Input::get('guid'));
            add_message("Spieler ". Input::get('name') ." wurde gekickt", MSG_TYPE_SUCCESS);
            Logger::addLog("kick",$uid,"Grund: ".Input::get('reason'));
            break;
        case 'tmpban':
            if (!$user->hasPermision("BanTmp")) {
                redirect(DE100_DOMAIN,"Dafür hast du nicht die Berechtigung",MSG_TYPE_ERROR);
            }
            $uid = $player->BEtoUID(Input::get('guid'));
            if ($player->isBaned($uid)) {
                add_message("Spieler ". Input::get('name') ." ist bereits gebannt.", MSG_TYPE_ERROR);
            } else {
                $ban->addBan(Input::get('guid'),Input::get('rconid'),Input::get('name'),$user->username(),Input::get('date'),Input::get('reason'));
                add_message("Spieler ". Input::get('name') ." wurde temporär gebannt.", MSG_TYPE_SUCCESS);
                Logger::addLog("tmpban",$uid,"Grund: ".Input::get('reason')." Bis: ". toDate(Input::get('date')));
            }
            break;
        case 'ban':
            if (!$user->hasPermision("BanPerm")) {
                redirect(DE100_DOMAIN,"Dafür hast du nicht die Berechtigung",MSG_TYPE_ERROR);
            }
            $uid = $player->BEtoUID(Input::get('guid'));
            if ($player->isBaned($uid)) {
                add_message("Spieler ". Input::get('name') ." ist bereits gebannt.", MSG_TYPE_ERROR);
            } else {
                $ban->addBan(Input::get('guid'),Input::get('rconid'),Input::get('name'),$user->username(),Input::get('date'),Input::get('reason'));
                add_message("Spieler ". Input::get('name') ." wurde permanent gebannt.", MSG_TYPE_SUCCESS);
                Logger::addLog("ban",$uid,"Grund: ".Input::get('reason'));
            }
            break;
        case 'show':
            if (!$user->hasPermision("PlayersEdit")) {
                redirect(DE100_DOMAIN,"Dafür hast du nicht die Berechtigung",MSG_TYPE_ERROR);
            }
            $uid = $player->BEtoUID(Input::get('guid'));
            if ($uid) {
                redirect(DIR_TO_SITES."editplayer?id=".$uid);
            }
            break;
    }
    redirect(DIR_TO_SITES."onlineplayers");
}

$DE100_GLOBALS['content'] = "onlineplayers";
$DE100_GLOBALS['title'] = "Online Spieler - " .DE100_SITE_NAME;
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
