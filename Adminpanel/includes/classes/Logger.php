<?php
/**
 * Tracker class for tracking site activity and security
 */
class Logger {
    public static function addLog($action = "", $target = 0, $details = "Keine Details") {
        global $db;
        global $user;
        $userID = $user->data()['id'];
                    
        $db->insertFromArray('logs', ['userID' => !$userID ? 0 : $userID, 'time' => time(), 'action' => $action, 'details' => $details , 'target' => $target]);
            
        return;
    }

    public static function getLogTyps()
    {
    	global $db;
        $query = $db->prepare("SELECT action FROM arma_online.logs GROUP BY action;");
        $actions = $db->getResultsArray($query);

        return $actions;
    }

  	public static function getLogs()
    {
    	global $db;
        $query = $db->prepare("SELECT l.*,u.username,p.name AS pname,g.name AS gname FROM arma_online.logs AS l LEFT JOIN arma_online.users AS u ON u.id=l.userID LEFT JOIN arma_main_server.players AS p ON p.uid=l.target LEFT JOIN arma_main_server.gang_system AS g ON g.id=l.target ORDER BY l.id DESC;");
        $logs = $db->getResultsArray($query);

        return $logs;
    }

    public static function getTypeName($classname='')
    {
        global $LOG_TYPE_NAME;
        if (isset($LOG_TYPE_NAME[$classname])) {
            return $LOG_TYPE_NAME[$classname];
        } else {
            return $classname;
        }
    }
}