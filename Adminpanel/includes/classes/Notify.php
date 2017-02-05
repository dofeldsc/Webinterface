<?php

class Notify {
	public static function addNotify($uid = 0,$text = "",$type = 0,$seen = 0)
	{
		global $db;

		if ($uid == 0 || $text == "") {
			return false;
		}
		$query = $db->prepare("INSERT INTO `arma_online`.`notif` (`user`, `text`, `type`, `seen`, `insertDate`) VALUES ('$uid', '$text', '$type', '$seen', NOW());");
		$db->insert($query);

		if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return true;
	}

	public static function count($uid = 0,$new = false)
	{
		global $db;

		if ($uid == 0) {
			return 0;
		}
		$ex = "";
		if ($new) {
			$ex = "AND `seen` = '0'";
		}

		$query = $db->prepare("SELECT COUNT(`id`) FROM `arma_online`.`notif` WHERE `user` = '$uid' $ex;");
		$data = $db->getVar($query);
		if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return 0;
        }
		if (!$data) {
			return 0;
		}
		return $data;
	}

	public static function get($uid = 0,$new = false,$limit = 5,$part = -1) 
	{
		global $db;

		if ($uid <= 0) {
			return false;
		}

		$ex = "";
		if ($new) {
			$ex = "AND `seen` = '0'";
		}

		if ($limit > 0) {
			$limit = "LIMIT $limit";
		} else {
			$limit = "";
		}

		if ($part > 0) {
			$part = "AND `id` > '$part'";
		} else {
			$part = "";
		}
		

		$query = $db->prepare("SELECT * FROM `arma_online`.`notif` WHERE `user` = '$uid' $ex $part ORDER BY `id` DESC $limit;");
		$data = $db->getResultsArray($query);
		if ($db->getLastError()) {
	        add_message($db->getLastError(), MSG_TYPE_ERROR);
	        return false;
	    }
	    return $data;
	}

	public static function seen($id=0)
	{
		global $db;

		if ($id <= 0) {
			return false;
		}

		$query = $db->prepare("UPDATE `arma_online`.`notif` SET `seen`='1' WHERE `id`='$id';");
		$db->update($query);
		if ($db->getLastError()) {
	        add_message($db->getLastError(), MSG_TYPE_ERROR);
	        return false;
	    }
	    return true;
	}

	public static function getLastID($uid='')
	{
		global $db;

		if ($uid <= 0) {
			return 0;
		}

		$query = $db->prepare("SELECT * FROM `arma_online`.`notif` WHERE `user` = '$uid' ORDER BY `id` DESC LIMIT 1;");
		$data = $db->getVar($query);
		if ($db->getLastError()) {
	        add_message($db->getLastError(), MSG_TYPE_ERROR);
	        return 0;
	    }

	    if (!$data) {
	    	return 0;
	    }
	    return $data;
	}
}