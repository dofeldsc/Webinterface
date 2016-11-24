<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
$player = new Player(Input::get('id'));
$vehicle = new Vehicle();
$playerInfo = $player->data();

if (Input::get('action')) {
    switch(Input::get('action')){
        case 'tmpban':
            //Permmision CHECK!! SINCE YOU CAN HACK THIS!
            if (!$user->hasPermision("BanTmp")) {
                redirect(DE100_DOMAIN,"Was hast du den da Versucht ?",MSG_TYPE_ERROR);
            }
            $player->addDirectBan(Input::get('date'),Input::get('reason'),$user->username());
            add_message("Spieler ". $playerInfo['name'] ." wurde temporär gebannt.", MSG_TYPE_SUCCESS);
            break;
        case 'ban':
            //Permmision CHECK!! SINCE YOU CAN HACK THIS!
            if (!$user->hasPermision("BanPerm")) {
                redirect(DE100_DOMAIN,"Was hast du den da Versucht ?",MSG_TYPE_ERROR);
            }
            $player->addDirectBan(-1,Input::get('reason'),$user->username());
            add_message("Spieler ". $playerInfo['name'] ." wurde permanent gebannt.", MSG_TYPE_SUCCESS);
            break;
    }
    redirect(DIR_TO_SITES ."editplayer.php/?id=".$playerInfo['uid']);
}


$DE100_GLOBALS['content'] = "editplayer";
$DE100_GLOBALS['title'] = $playerInfo['name'] . " bearbeiten - " .DE100_SITE_NAME;
$DE100_GLOBALS['permission'] = "PlayersEdit";
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
