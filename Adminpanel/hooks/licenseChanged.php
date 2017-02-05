<?php
    require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
    $user = new User();
    if (!$user->hasPermision("PlayersEdit") || !$user->isLoggedIn()) {
        die();
    }
    $player = new Player(Input::get('player'));
    $side = Input::get('side');
    $lic = Input::get('lic');
    $playerInfo = $player->data();
    $array = toPhpArray($playerInfo[$side.'_licenses']);
    $index = array_search($lic,array_column($array, 0));
    if ($array[$index][1] == 1) {
        $array[$index][1] = 0;
        Logger::addLog("playerEdit", Input::get('player'), "Lizenz entfernt: ".$player->getLicName($lic) );
    } else {
        $array[$index][1] = 1;
        Logger::addLog("playerEdit", Input::get('player'), "Lizenz hinzugefügt: ".$player->getLicName($lic));
    }
    $array = '"'.toArmaEscapedArray($array).'"';
    $player->updateLic($array,$side.'_licenses');
