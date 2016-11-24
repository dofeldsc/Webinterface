<?php
/**
 * Tracker class for tracking site activity and security
 */
class Tracker {
    public static function addTrack($action = "login") {
        global $db;
        
        $userID = is_logged_in();
        $ip = $_SERVER['REMOTE_ADDR'];
        $time = time();
        
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            
        if ($ip != '127.0.0.1')
            $db->insertFromArray('tracker', ['userID' => !$userID ? 0 : $userID, 'ipAddr' => $ip, 'trackedTime' => $time, 'action' => $action]);
            
        return;
    }
    
    public static function getLoginAttempts() {
        global $db;
        
        $ip = $_SERVER['REMOTE_ADDR'];
        
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            
        $time = time() - MAX_LOGIN_ATTEMPT_PERIOD;
        $query = "SELECT COUNT(1) FROM tracker WHERE ipAddr='$ip' AND trackedTime > '$time' AND action='login'";
        $count = $db->getVar($query);
        
        return $count;
    }
    
    public static function clearLoginAttempts() {
        global $db;
        
        $ip = $_SERVER['REMOTE_ADDR'];
        
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            
        $time = time() - MAX_LOGIN_ATTEMPT_PERIOD;
        $query = "DELETE FROM tracker WHERE ipAddr='$ip' AND action='login'";
        $db->query($query);
        
        return;
    }
}