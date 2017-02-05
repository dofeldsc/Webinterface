<?php
    require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
    $user = new User();
    $type = Input::get('type');
    switch ($type) {
    	case 'adminlevel':
    		$perm = "AdRank";
    		$text = "Admin Level geändert von ";
    		break;

    	case 'nobody_level':
    		$perm = "NoBodyRank";
    		$text = "NoBody Level geändert von ";
    		break;
    	
    	case 'thrlevel':
    		$perm = "ThrRank";
    		$text = "THR Level geändert von ";
    		break;

    	case 'coplevel':
    		$perm = "CopRank";
    		$text = "Polizei Level geändert von ";
    		break;

    	default:
    		$perm = "";
    		break;
    }
    if (!$user->hasPermision($perm) || !$user->isLoggedIn()) {
        die();
    }
    $player = new Player(Input::get('id'));
    $oldVal = $player->data()[$type];
    $newVal = Input::get('value');

    $player->editLevel($type,$newVal);
    Logger::addLog("playerEdit", Input::get('id'), $text.$oldVal." zu ".$newVal);
