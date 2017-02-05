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
        
        $query = ("SELECT DATE_FORMAT(`players`.`first_login`,GET_FORMAT(DATE,'EUR')) AS `date`, COUNT(`players`.`uid`) AS `count`,DATE_FORMAT(`players`.`first_login`,'%Y-%m-%dT') AS `date_formatted` FROM arma_main_server.`players` GROUP BY `date` HAVING `date` IS NOT NULL ORDER BY `uid` DESC LIMIT 14");
        $array = $db->getResultsArray($query);
        return $array;
    }

    public static function getTotalPlayerHistory($type = "PlayerTotal") {
        global $db;
        
        $query = ("SELECT `data`, DATE_FORMAT(`date`,'%Y-%m-%dT%T') AS `date` FROM arma_main_server.`db_stats` WHERE type='$type' ORDER by id desc LIMIT 144;");
        $array = $db->getResultsArray($query);
        return $array;
    }
    
    public static function getSteamID($guid) {
        global $db;
        $query = $db->prepare("SELECT `playerid` FROM `arma_main_server`.`players` WHERE `guid`='$guid';");
        $uid = $db->getVar($query);
        if ($uid == "") {
            $uid = "Keine SteamID vorhanden";
        }
        return $uid;
    }

    public static function BEtoUID($guid) {
        global $db;
        $query = $db->prepare("SELECT `uid` FROM `arma_main_server`.`players` WHERE `guid`='$guid';");
        $uid = $db->getVar($query);
        return $uid;
    }

    public static function PIDtoUID($pid) {
        global $db;
        $query = $db->prepare("SELECT `uid` FROM `arma_main_server`.`players` WHERE `playerid`='$pid';");
        $uid = $db->getVar($query);
        return $uid;
    }

    public static function nameFromPID($pid) {
        global $db;
        $query = $db->prepare("SELECT `name` FROM `arma_main_server`.`players` WHERE `playerid`='$pid';");
        $name = $db->getVar($query);
        if ($name) {
            return $name;
        } else {
            return $pid;
        }
        
    }
    
    public static function nameFromUID($uid) {
        global $db;
        $query = $db->prepare("SELECT `name` FROM `arma_main_server`.`players` WHERE `uid`='$uid';");
        $name = $db->getVar($query);
        if ($name) {
            return $name;
        } else {
            return $uid;
        }
        
    }

    public function data() {
        if (isset($this->_data)) {
            return $this->_data;
        } else {
            return false;
        }
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

    public function banCounter($uid)
    {
        global $db;
        $query = $db->prepare("SELECT COUNT(*) FROM `arma_main_server`.`bans` WHERE `playerid`='$uid';");
        $id = $db->getVar($query);
        if (!$id) {
            return false;
        }
        return $id;
    }
    
    public static function getLicName($classname) {
        global $ARMA_LICENSES;
        if (isset($ARMA_LICENSES[$classname])) {
            return $ARMA_LICENSES[$classname];
        } else {
            return $classname;
        }
    }

    public static function getItemName($classname) {
        global $ARMA_ITEMS;
        global $ALTIS_ITEMS;
        if (isset($ARMA_ITEMS[$classname])) {
            return $ARMA_ITEMS[$classname];
        } elseif (isset($ALTIS_ITEMS[$classname])) {
            return $ALTIS_ITEMS[$classname];
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

    public function getVehiclesCount($pid = "") {
        global $db;
        if ($pid == "") {
            $pid = $this->_data['playerid'];
        }
        $query = $db->prepare("SELECT Count(pid) FROM `arma_main_server`.`vehicles` WHERE `pid`='$pid';");
        $data = $db->getVar($query);
        return $data;
    }

    public function getHousesCount($pid = "") {
        global $db;
        if ($pid == "") {
            $pid = $this->_data['playerid'];
        }
        $query = $db->prepare("SELECT Count(pid) FROM `arma_main_server`.`houses` WHERE `pid`='$pid';");
        $data = $db->getVar($query);
        return $data;
    }

    public function getSkin($classname = 'U_C_Man_casual_1_F')
    {
        if (file_exists(DIR_IMGS.'clothing/'.$classname.'.png')) {
            return DIR_TO_IMG.'clothing/'.$classname.'.png';
        } else {
            return DIR_TO_IMG.'clothing/'.'U_C_Man_casual_1_F.png';
        }
        
    }

    public function getBans($uid)
    {
        global $db;
        $query = $db->prepare("SELECT * FROM `arma_main_server`.`bans` WHERE `playerid`='$uid';");
        $data = $db->getResultsArray($query);
        if (!$data) {
            return false;
        }
        return $data;
    }

    public static function topBans()
    {
        global $db;

        $query = $db->prepare("SELECT count(*) AS counter, b.name,p.uid FROM arma_main_server.bans AS b LEFT JOIN arma_main_server.players as p ON p.playerid=b.playerid GROUP BY b.playerid ORDER BY counter DESC LIMIT 10;");
        $data = $db->getResultsArray($query);
        if (!$data) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $data;
    }

    public function addComment($text,$user_id)
    {
        global $db;
        $id = $this->_data['uid'];
        $query = $db->prepare("INSERT INTO `arma_online`.`player_comments` (`player_id`, `author_id`, `text`, `date`) VALUES ('$id', '$user_id', '$text', NOW());");
        $data = $db->insert($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        add_message("Kommentar hinzugefügt", MSG_TYPE_SUCCESS);
        return $data;
    }

    public function getComments()
    {
        global $db;
        $id = $this->_data['uid'];
        $query = $db->prepare("SELECT pc.*,u.username AS author_name FROM player_comments AS pc LEFT JOIN users AS u on pc.author_id = u.id WHERE pc.player_id='$id';");
        $data = $db->getResultsArray($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $data;
    }

    public function getPlayerLogs()
    {
        global $db;
        $id = $this->_data['playerid'];
        $query = $db->prepare("SELECT l.*,(SELECT text FROM arma_online.ig_log_type AS t WHERE t.id=l.type) AS text FROM arma_main_server.logs AS l WHERE pid='$id';");
        $data = $db->getResultsArray($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $data;
    }

    public function getPlayerLogType()
    {
        global $db;
        $id = $this->_data['playerid'];
        $query = $db->prepare("SELECT * FROM arma_online.ig_log_type ORDER BY text;");
        $data = $db->getResultsArray($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $data;
    }

    public function removeComment($id,$authid)
    {
        global $db;
        $query = $db->prepare("DELETE FROM player_comments WHERE id='$id' AND author_id='$authid';");
        $db->query($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        add_message("Kommentar gelöscht", MSG_TYPE_SUCCESS);
        return true;
    }

    public function updateInvPack($val)
    {
        global $db;
        $uid = $this->_data['uid'];
        $query = $db->prepare("UPDATE `arma_main_server`.`players` SET `backpack`='$val' WHERE `uid`='$uid';");
        $db->update($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return true;
    }

    public function editLevel($varName,$value)
    {
        global $db;
        $uid = $this->_data['uid'];
        $query = $db->prepare("UPDATE `arma_main_server`.`players` SET `$varName`='$value' WHERE `uid`='$uid';");
        $db->update($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return true;
    }

    public function editMoney($value=0)
    {
        global $db;
        $uid = $this->_data['uid'];
        $query = $db->prepare("UPDATE `arma_main_server`.`players` SET `bankacc`=`bankacc`+'$value' WHERE `uid`='$uid';");
        $db->update($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return true;
    }

    public function getTransactions()
    {
        global $db;
        $id = $this->_data['playerid'];
        $query = $db->prepare("SELECT * FROM `arma_main_server`.`bank` WHERE `sender`='$id' OR `receiver`='$id' ORDER BY `id` DESC;");
        $data = $db->getResultsArray($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $data;
    }

    public function getOnlineInventory($type)
    {
        global $db;
        $id = $this->_data['playerid'];
        switch ($type) {
            case 'weapon':
                $type = '("weapon","attachment","magazin")';
                break;
            
            case 'clothing':
                $type = '("uniform","backpack","helmt","glasses")';
                break;

            case 'vitems':
                $type = '("vItems")';
                break;

            case 'other':
                $type = '("medikits","other")';
                break;

            default:
                $type = '("")';
                break;
        }
        $query = $db->prepare("SELECT * FROM `arma_online`.`items` WHERE `owner`='$id' AND `isOnline`='1' AND `type` IN $type;");
        $data = $db->getResultsArray($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $data;
    }

    public static function sendItemsToGame($items='("")')
    {
        global $db;
        $query = $db->prepare("UPDATE `arma_online`.`items` SET `isOnline`='0' WHERE `id` IN $items");
        $error = $db->update($query);
        if (!$error) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $error;
    }
}