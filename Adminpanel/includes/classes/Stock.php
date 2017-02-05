<?php
class Stock {
    public function __construct() {
        global $db;
        
        $query = $db->prepare("SELECT * FROM `arma_main_server`.`dynmarkt`;");
        $data = $db->getResultsArray($query);

        if (count($data)) {
            $this->_data = $data;
        } else {
            $this->_data = [];
        }
    }

    public function data() {
        if (isset($this->_data)) {
            return $this->_data;
        } else {
            return false;
        }
    }

    public static function getHistory($type = "beton_refined",$crntPrice = "") {
        global $db;
        
        $query = ("SELECT `data`, DATE_FORMAT(`date`,'%Y-%m-%dT%T') AS `date` FROM arma_main_server.`db_stats` WHERE type='$type' ORDER by id desc;");
        $array = $db->getResultsArray($query);
        $array[0] = ['data'=>$crntPrice,'date'=>date('Y-m-d\TH:i:s')];
        return $array;
    }
}