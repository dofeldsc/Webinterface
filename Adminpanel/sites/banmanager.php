<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
$ban = new Ban();


if (Input::get('action')) {
    switch (Input::get('action')) {
        case 'unban':
        	$uid = Player::PIDtoUID(Input::get('playerid'));
            Logger::addLog("unban",$uid,"Grund: ".Input::get('reason'));
            $ban->unban(Input::get('banid'));
            add_message("Spieler ". Input::get('name')." wurde entbannt", MSG_TYPE_SUCCESS);
            break;
        case 'tmpban':
        	$ban = new Ban(Input::get('id'));
        	$banData = $ban->data();
        	$uid = Player::PIDtoUID(Input::get('playerid'));
        	$change = "";
        	$data = [
        		'datum' => Input::get('date'),
        		'grund' => Input::get('reason')
        	];

        	if ($banData['datum'] < 0) {
        		$change = $change."Perm &rarr; Temp ";
        	}

        	if ($banData['grund'] != Input::get('reason')) {
        		$change = $change."Neuer Grund: ".Input::get('reason');
        	}
        	if ($change == "") {
        		add_message("Fehler, es wurde nichts geändert", MSG_TYPE_ERROR);
        	} else {
	            $ban->updateBan($data,['id' => Input::get('id')]);
	            Logger::addLog("banChanged",$uid,$change);
	            add_message("Ban ID ". Input::get('id') ." wurde bearbeitet.", MSG_TYPE_SUCCESS);
	        }
            break;
        case 'ban':
        	$ban = new Ban(Input::get('id'));
        	$banData = $ban->data();
        	$uid = Player::PIDtoUID(Input::get('playerid'));
        	$change = "";
        	$data = [
        		'datum' => '-1',
        		'grund' => Input::get('reason')
        	];
        	if ($banData['datum'] > 0) {
        		$change = $change."Temp &rarr; Perm ";
        	}

        	if ($banData['grund'] != Input::get('reason')) {
        		$change = $change."Neuer Grund: ".Input::get('reason');
        	}

        	if ($change == "") {
        		add_message("Fehler, es wurde nichts geändert", MSG_TYPE_ERROR);
        	} else {
	            $ban->updateBan($data,['id' => Input::get('id')]);
	            Logger::addLog("banChanged",$uid,$change);
	            add_message("Ban ID ". Input::get('id') ." wurde bearbeitet.", MSG_TYPE_SUCCESS);
        	}
            break;
    }
    redirect(DIR_TO_SITES."banmanager");
}

$DE100_GLOBALS['content'] = "banmanager";
$DE100_GLOBALS['title'] = "Bans Verwalten - " .DE100_SITE_NAME;
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
