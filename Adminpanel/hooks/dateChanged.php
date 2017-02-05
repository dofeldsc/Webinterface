<?php
    require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
    $user = new User();
    if (!$user->hasPermision('InvBack') || !$user->isLoggedIn()) {
        die();
    }
    $player = new Player(Input::get('id'));
    $oldVal = strtotime($player->data()['backpack']);
    var_dump(Input::get('value'));

    if ($oldVal > time() && !(Input::get('value') < 0)) {
    	$newVal = $oldVal + Input::get('value') * 24 * 60 * 60;
    	$text = "Unsichtbarer Rucksack verlängert ".date("d.m.Y H:i:s",$oldVal)." &rarr; ".date("d.m.Y H:i:s",$newVal);
    	$newVal = date("Y-m-d H:i:s",$newVal);
    } else if (Input::get('value') < 0) {
		$newVal = 0;
    	$text = "Unsichtbarer Rucksack entfernt";
    } else {
    	$newVal = time() + Input::get('value') * 24 * 60 * 60;
    	$text = "Unsichtbarer Rucksack bis ".date("d.m.Y H:i:s",$newVal);
    	$newVal = date("Y-m-d H:i:s",$newVal);
    }
    var_dump($newVal);
    $player->updateInvPack($newVal);
    Logger::addLog("playerEdit", Input::get('id'), $text);
