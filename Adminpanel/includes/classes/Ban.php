<?php

class Ban {
    public function __construct($banID = null) {
        global $db;
        if ($banID) {
	        $sql = $db->prepare("SELECT * FROM arma_main_server.bans WHERE id='$banID';");
	        $data = $db->getResultsArray($sql);
	        if (empty($data)) {
	        	return false;
	        }
	        $data = $data[0];
	        $this->_data = $data;
	        return true;
        }
    }

    public function data() {
        return $this->_data;
    }

    public function addBan($guid,$rconid,$name,$admin,$date,$reason) {
        global $db;
        global $rcon;
        $steamid = Player::getSteamID($guid);
        if ($date < 0) {
            $type = " permanent";    
        } else {
            $type = " temporär";
        }
        
        $query = $db->prepare("INSERT INTO `arma_main_server`.`bans` (`name`, `playerid`, `von`, `datum`, `status`, `grund`,`insert_time`) VALUES ('$name', '$steamid', '$admin', '$date', 'true', '$reason', NOW())");
        $newID = $db->insert($query);
        if (!$newID) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        $rcon->kickPlayer($rconid,'Du wurdest von ' . $admin . $type .' gebannt. Grund: '. $reason);
        return $newID;
    }
    
    public function addDirectBan($date,$reason,$admin,$name,$steamid) {
        global $db;
        $query = $db->prepare("INSERT INTO `arma_main_server`.`bans` (`name`, `playerid`, `von`, `datum`, `status`, `grund`,`insert_time`) VALUES ('$name', '$steamid', '$admin', '$date', 'true', '$reason', NOW())");
        $newID = $db->insert($query);
        if (!$newID) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $newID;
    }

    public function unban($banID) {
        global $db;
        $query = $db->prepare("UPDATE `arma_main_server`.`bans` SET `status`='false' WHERE `id`='$banID'");
        $newID = $db->update($query);
        if (!$newID) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $newID;
    }

    public function updateBan($data,$id)
    {
    	global $db;
    	$db->updateFromArray('arma_main_server.bans', $data, $id);
    }
}