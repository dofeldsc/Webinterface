<?php

class Auction {
    public function __construct($itemID = null) {
        global $db;
        if ($itemID) {
	        $sql = $db->prepare("SELECT `a`.*,`a`.`id` AS `a_id`,`i`.`id` AS `i_id`,`i`.*,(SELECT `name` FROM `arma_main_server`.`players` AS `p` WHERE `p`.`playerid` = `a`.`seller`) AS `owner_name`,(SELECT `name` FROM `arma_main_server`.`players` AS `p` WHERE `p`.`playerid` = `a`.`currentHolder`) AS `currentHolder_name`,TIME_TO_SEC(TIMEDIFF(NOW(),`a`.`expireDate`)) AS `time_left` FROM `arma_online`.`auctions` AS `a` LEFT JOIN `arma_online`.`items` AS `i` ON `i`.`id`=`a`.`itemid` WHERE `a`.`id` = $itemID;");
	        $data = $db->getResultsArray($sql);
	        if (empty($data)) {
	        	return false;
	        }
	        $data = $data[0];
            if ($data['time_left'] >= 0) {
                $data['sold'] = 1;
            }
	        $this->_data = $data;
	        return true;
        }
    }

    public function data() {
        if (isset($this->_data)) {
            return $this->_data;
        } else {
            return false;
        }
    }

    public function getBetHistory($limit=0)
    {
        global $db;
        $id = $this->data()['a_id'];
        $query = $db->prepare("SELECT h.*,(SELECT `name` FROM `arma_main_server`.`players` AS `p` WHERE `p`.`playerid` = `h`.`person`) AS `person_name` FROM `arma_online`.`auction_bet_history` AS `h` WHERE `h`.`auctionID` = '$id' AND `h`.`id` > $limit;");
        $data = $db->getResultsArray($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $data;
    }

    public function crntPrice()
    {
        global $db;
        $id = $this->data()['a_id'];
        $query = $db->prepare("SELECT `currentPrice` FROM `arma_online`.`auctions` WHERE `id`='$id';");
        $data = $db->getVar($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $data;
    }

    public static function onlineStatus($id) {
        global $db;
        $query = $db->prepare("SELECT `isOnline` FROM `arma_online`.`items` WHERE `id`='$id';");
        $data = $db->getVar($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $data;
    }

    public static function addAuction($iid,$pid,$bn,$sp,$edate) {
        global $db;
        $query = $db->prepare("INSERT INTO `arma_online`.`auctions` (`itemid`, `seller`, `buynow`, `currentPrice`, `startPrice`, `expireDate`, `startDate`, `sold`, `wasBuyNow`) VALUES ('$iid', '$pid', '$bn', '$sp', '$sp', '$edate', NOW(), '0', '0');");
        $data = $db->insert($query);

        $query = $db->prepare("UPDATE `arma_online`.`items` SET `isOnline`='2' WHERE `id`='$iid';");
        $db->update($query);

        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return "-1";
        }
        return $data;
    }

    public function isSold()
    {
        global $db;
        $id = $this->data()['a_id'];
        $query = $db->prepare("SELECT `sold` FROM `arma_online`.`auctions` WHERE `id`='$id';");
        $data = $db->getVar($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return ($data == 1);
    }

    public function buyNow($pid="")
    {
        global $db;
        global $user;
        $target = new User($this->data()['seller']);
        $target->editOnlineMoney($this->data()['buynow']);
        $id = $this->data()['a_id'];
        $iid = $this->data()['i_id'];
        if ($this->isSold()) {
            return 2;
        }
        $query = $db->prepare("UPDATE `arma_online`.`auctions` SET `currentHolder`='$pid', `sold`='1' ,`wasBuyNow`='1' WHERE `id`='$id';");
        $db->update($query);

        $query = $db->prepare("UPDATE `arma_online`.`items` SET `owner`='$pid', `isOnline`='1' WHERE `id`='$iid';");
        $db->update($query);

        $query = $db->prepare("INSERT INTO `arma_online`.`auction_bet_history` (`auctionID`, `person`, `amount`, `timestamp`) VALUES ('$id', '$pid', 'Sofortkauf', NOW());");
        $db->insert($query);

        Notify::addNotify($target->id(),'Deine '.Player::getItemName($this->data()['class']).' wurde von '.Player::nameFromPID($pid).' für $'.number_format($this->data()['buynow'],0, '.', ",").' über Sofortkauf gekauft.<br>Link zur Auktion: <a target="_blank" href="'.DIR_TO_SITES.'article?id='.$id.'">Link</a>');

        Notify::addNotify($user->id(),'Du hast '.Player::getItemName($this->data()['class']).' von '.$this->data()['owner_name'].' für $'.number_format($this->data()['buynow'],0, '.', ",").' über Sofortkauf gekauft.<br>Link zur Auktion: <a target="_blank" href="'.DIR_TO_SITES.'article?id='.$id.'">Link</a>');

        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return 0;
        }
        return 1;
    }

    public function addBet($pid = "",$amt = 0)
    {
        global $db;
        $id = $this->data()['a_id'];
        $target = new User($this->data()['currentHolder']);
        if ($amt <= $this->crntPrice()) {
            return 2;
        }
        $query = $db->prepare("UPDATE `arma_online`.`auctions` SET `currentPrice`='$amt', `currentHolder`='$pid' WHERE `id`='$id';");
        $db->update($query);
        $query = $db->prepare("INSERT INTO `arma_online`.`auction_bet_history` (`auctionID`, `person`, `amount`, `timestamp`) VALUES ('$id', '$pid', '$amt', NOW());");
        $db->insert($query);
        if ($pid != $traget->steamID()) {
            Notify::addNotify($target->id(),'Du wurdest von '.Player::nameFromPID($pid).' überboten.<br>Neues Höchstgebot: $'.number_format($this->data()['currentPrice'],0, '.', ",").'<br>Link zur Auktion: <a target="_blank" href="'.DIR_TO_SITES.'article?id='.$id.'">Link</a>');
        }

        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return 0;
        }
        return 1;
    }

    public function getLastBetID()
    {
        global $db;
        $id = $this->data()['a_id'];
        $query = $db->prepare("SELECT `h`.`id` FROM `arma_online`.`auction_bet_history` AS `h` WHERE `h`.`auctionID` = '1' ORDER BY `h`.`id` DESC LIMIT 1;");
        $data = $db->getVar($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $data;
    }

    public static function getAuctions($type) {
        global $db;
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
        $query = $db->prepare("SELECT `a`.*,`a`.`id` AS `a_id`,`i`.*,(SELECT `name` FROM `arma_main_server`.`players` AS `p` WHERE `p`.`playerid` = `a`.`seller`) AS `owner_name` FROM `arma_online`.`auctions` AS `a` LEFT JOIN `arma_online`.`items` AS `i` ON `i`.`id`=`a`.`itemid` WHERE TIMEDIFF(NOW(),`a`.`expireDate`) < 0 AND `a`.`sold` = '0' AND `i`.`type` IN $type;");

        $data = $db->getResultsArray($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $data;
    }
}