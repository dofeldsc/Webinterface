<?php
class Player {
    public function __construct($player = null) {
        global $db;
        
        if ($player) {
            $this->find($player);
        }
    }
    
    public function find($uid) {
        global $db;
        $query = "SELECT p.*,g.id AS gang_id,g.name AS gang_name FROM arma_main_server.`players` AS p LEFT JOIN arma_main_server.`gang_system` AS g ON g.members LIKE CONCAT('%',p.playerid,'%') WHERE p.uid='$uid';";
        $data = $db->getResultsArray($query);
        if (count($data)) {
            $this->_data = $data[0];
            return true;
        }
        return false;
    }
    
    public static function getNewestPlayer() {
        global $db;
        $query = $db->prepare("SELECT `name` FROM `arma_main_server`.`players` WHERE first_login !='To Old' ORDER BY `first_login` DESC LIMIT 1;");
        return $db->getVar($query);
    }
    
    public static function countPlayers() {
        global $db;
        $query = $db->prepare("SELECT COUNT(*) FROM `arma_main_server`.`players`;");
        return $db->getVar($query);
    }
    
    public function getAllPlayers() {
        global $db;
        $query = $db->prepare("SELECT * FROM `arma_main_server`.`players`;");
        return $db->getResultsArray($query);
    }
    
    public static function getNewestPlayerHistory() {
        global $db;
        
        $query = $db->prepare("SELECT DATE(`players`.`first_login`) AS `date`, COUNT(`players`.`uid`) AS `count` FROM arma_main_server.`players` GROUP BY `date` HAVING `date` IS NOT NULL ORDER BY `date` DESC LIMIT 14");
        $array = $db->getResultsArray($query);
        return $array;
    }
    
    public function addBan($guid,$rconid,$name,$admin,$date,$reason) {
        global $db;
        global $rcon;
        $steamid = $this->getSteamID($guid);
        if ($date < 0) {
            $type = " permanent";    
        } else {
            $type = " temporär";
        }
        
        $query = $db->prepare("INSERT INTO `arma_main_server`.`bans` (`name`, `playerid`, `von`, `datum`, `status`, `grund`) VALUES ('$name', '$steamid', '$admin', '$date', 'true', '$reason')");
        $newID = $db->insert($query);
        if (!$newID) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        $rcon->kickPlayer($rconid,'Du wurdest von ' . $admin . $type .' gebannt. Grund: '. $reason);
        return $newID;
    }
    
    public function addDirectBan($date,$reason,$admin) {
        global $db;
        $name = $this->_data["name"];
        $steamid = $this->_data["playerid"];
        $query = $db->prepare("INSERT INTO `arma_main_server`.`bans` (`name`, `playerid`, `von`, `datum`, `status`, `grund`) VALUES ('$name', '$steamid', '$admin', '$date', 'true', '$reason')");
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
    
    public function getSteamID($guid) {
        global $db;
        $query = $db->prepare("SELECT `playerid` FROM `arma_main_server`.`players` WHERE `guid`='$guid';");
        $uid = $db->getVar($query);
        if ($uid == "") {
            $uid = "Keine SteamID vorhanden";
        }
        return $uid;
    }
    
    public function data() {
        return $this->_data;
    }
    
    public static function banData($id) {
        global $db;
        $query = $db->prepare("SELECT * FROM `arma_main_server`.`bans` WHERE `id`='$id';");
        return $db->getResultsArray($query)[0];
    }
    
    public function isBaned($uid) {
        global $db;
        $query = $db->prepare("SELECT id FROM `arma_main_server`.`bans` WHERE `playerid`='$uid' AND `status`='true';");
        $id = $db->getVar($query);
        if (!$id) {
            return false;
        }
        return $id;
    }
    
    public function getLicName($classname) {
        global $ARMA_LICENSES;
        if (isset($ARMA_LICENSES[$classname])) {
            return $ARMA_LICENSES[$classname];
        } else {
            return $classname;
        }
    }

    public function updateLic($licenses,$key) {
        global $db;
        $id = $this->_data['uid'];
        $query = $db->prepare("UPDATE `arma_main_server`.`players` SET `$key`='$licenses' WHERE `uid`='$id'");
        $error = $db->update($query);
        if (!$error) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $error;
    }

    public function getVehicles($pid = "") {
        global $db;
        if ($pid == "") {
            $pid = $this->_data['playerid'];
        }
        $query = $db->prepare("SELECT * FROM `arma_main_server`.`vehicles` WHERE `pid`='$pid';");
        $data = $db->getResultsArray($query);
        return $data;
    }
}




