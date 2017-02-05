<?php
class Vehicle {
    public function __construct($id = null) {
        global $db;
        
        if ($id) {
            $query = $db->prepare("SELECT v.*, p.`name`, p.`uid` FROM `arma_main_server`.`vehicles` AS v LEFT JOIN `arma_main_server`.`players` AS p ON v.`pid` = p.`playerid` WHERE `id`='$id';");
            $data = $db->getResultsArray($query);

            if (count($data)) {
                $this->_data = $data[0];
            } else {
                $this->_data = [];
            }
        }
    }
    
    public static function countVehicles() {
        global $db;
        $query = $db->prepare("SELECT COUNT(*) FROM `arma_main_server`.`vehicles`;");
        return $db->getVar($query);
    }
    
    public function resetVehicle($id,$adv=false)
    {
        global $db;
        if ($adv) {
            $query = $db->prepare("UPDATE `arma_main_server`.`vehicles` SET `alive`='1', `active`='0', `chopShop`=NULL WHERE `id`='$id'");
        } else {
            $query = $db->prepare("UPDATE `arma_main_server`.`vehicles` SET `alive`='1', `active`='0' WHERE `id`='$id'");
        }
        
        $newID = $db->update($query);
        if (!$newID) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $newID;
    }

    public function data() {
        return $this->_data;
    }
    
    public static function convertType($type) {
        switch ($type) {
            case 'Car':
                return "Fahrzeug";
                break;
                
            case 'Air':
                return "Luftfahrzeug";
                break;
                
            case 'Ship':
                return "Schiff";
                break;
               
            
            default:
                return $type;
                break;
        }
    }
    
    public static function convertSide($side) {
        switch ($side) {
            case 'civ':
                return "Zivilist";
                break;
                
            case 'cop':
                return "Polizei";
                break;
                
            case 'thr':
                return "THR";
                break;
               
            case 'adac':
                return "Adac";
                break;
            
            default:
                return $side;
                break;
        }
    }
    public static function getVehName($classname) {
        global $ARMA_VEHICLES;
        if (isset($ARMA_VEHICLES[$classname])) {
            return $ARMA_VEHICLES[$classname];
        } else {
            return $classname;
        }
    }

    public static function getVehColor($veh,$color) {
        global $ARMA_VEHICLE_COLORS;
        if (isset($ARMA_VEHICLE_COLORS[$veh][$color])) {
            return $ARMA_VEHICLE_COLORS[$veh][$color];
        } else {
            return "Arma3-Standart";
        }
    }
}