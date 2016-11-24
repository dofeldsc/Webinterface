<?php

require_once 'arc.php';

use \Nizarii\ARC;


	try{
	  	$rcon = new ARC('164.132.204.214', 'EcqRh4TAJck6Kv3307', 3322);
	    $playerOn = count(getPlayersArray());
	    foreach (toPHPArray()as $Data)
	    	echo $data[3];
	    }
		print_r(playerOn);	   

	}catch(Exception $e){
		echo "Ups! Something went wrong: {$e->getMessage()}";
	}
?>


