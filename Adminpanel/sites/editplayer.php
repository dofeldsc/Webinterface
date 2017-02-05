<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
$player = new Player(Input::get('id'));
$ban = new Ban();
$vehicle = new Vehicle();
$validate = new Validate();
$playerInfo = $player->data();

if (!$playerInfo) {
    redirect(DE100_DOMAIN,"Der Spieler konnte nicht gefunden werden",MSG_TYPE_ERROR);
}

if (Input::get('action')) {
    switch(Input::get('action')){
        case 'tmpban':
            if ($player->isBaned($playerInfo['playerid'])) {
                add_message("Spieler ". $playerInfo['name'] ." ist bereits gebannt.", MSG_TYPE_ERROR);
            } else {
                if (!$user->hasPermision("BanTmp")) {
                    redirect(DE100_DOMAIN,"Dafür hast du nicht die Berechtigung",MSG_TYPE_ERROR);
                }
                $ban->addDirectBan(Input::get('date'),Input::get('reason'),$user->username(),$playerInfo['name'],$playerInfo['playerid']);
                add_message("Spieler ". $playerInfo['name'] ." wurde temporär gebannt.", MSG_TYPE_SUCCESS);
                Logger::addLog("tmpban",$playerInfo['uid'],"Grund: ".Input::get('reason')." Bis: ". toDate(Input::get('date')));
            }
            break;
        case 'ban':
            if ($player->isBaned($playerInfo['playerid'])) {
                add_message("Spieler ". $playerInfo['name'] ." ist bereits gebannt.", MSG_TYPE_ERROR);
            } else {
                if (!$user->hasPermision("BanPerm")) {
                    redirect(DE100_DOMAIN,"Dafür hast du nicht die Berechtigung",MSG_TYPE_ERROR);
                }
                $ban->addDirectBan(-1,Input::get('reason'),$user->username(),$playerInfo['name'],$playerInfo['playerid']);
                add_message("Spieler ". $playerInfo['name'] ." wurde permanent gebannt.", MSG_TYPE_SUCCESS);
                Logger::addLog("ban",$playerInfo['uid'],"Grund: ".Input::get('reason'));
            }
            break;
    }
    redirect(DIR_TO_SITES ."editplayer?id=".$playerInfo['uid']);
}

if (Input::get('add_comment')) {
    $validation = $validate->check($_POST, [
        'add_comment' => [ 'required' => true, 'max' => 2000 ]
    ]);
    if (!$validation->passed()) {
        foreach ($validation->errors() as $error) {
            add_message($error, MSG_TYPE_ERROR);
        }
    } else {
        $player->addComment(Input::get('add_comment'),$user->data()['id']);
    }
}

if (Input::get('remove_comment')) {
    $player->removeComment(Input::get('remove_comment'),$user->data()['id']);
    redirect(DIR_TO_SITES ."editplayer?id=".$playerInfo['uid']);
}

if (Input::has()) {
    if (!$user->hasPermision("PCash")) {
        redirect(DE100_DOMAIN,"Dafür hast du nicht die Berechtigung",MSG_TYPE_ERROR);
    }
    $validate = new Validate();
    $validation = $validate->check($_POST, [
        'added_money' => [ 'required' => true]
    ]);
    if ($validation->passed()) {
        $val = Input::get('added_money');
        if ($playerInfo['bankacc'] + $val < 0) {
            add_message("Der Kontostand darf nie negativ sein!", MSG_TYPE_ERROR);
        } else {
            if ($val != 0) {
                $player->editMoney(Input::get('added_money'));
                if (Input::get('added_money') > 0) {
                    $text = "dem Bankkonto hinzugefügt.";
                } else {
                    $text = "vom Bankkonto abgezogen.";
                    $val = $val * -1;
                }
                add_message("Dem Spieler ".$playerInfo['name']." wurden "."$".number_format($val,0, ",", ".")." ".$text, MSG_TYPE_SUCCESS);
                Logger::addLog("playerEdit",$playerInfo['uid'],"$".number_format($val,0, ",", ".")." wurden ".$text);  
            } else {
                add_message("Du darfst nicht 0 eingeben!", MSG_TYPE_ERROR);
            }
        }
    }
    redirect(DIR_TO_SITES ."editplayer?id=".$playerInfo['uid']);
}

$DE100_GLOBALS['content'] = "editplayer";
$DE100_GLOBALS['title'] = $playerInfo['name'] . " bearbeiten - " .DE100_SITE_NAME;
$DE100_GLOBALS['permission'] = "PlayersEdit";
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
