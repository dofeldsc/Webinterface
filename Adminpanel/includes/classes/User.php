<?php

class User {

        private $_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn;

    public function __construct($user = null) {
        global $db;
        
        $this->_sessionName = "user";
        if (!$user) {
            if (Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);
                if ($this->find($user)) {
                    $this->_isLoggedIn = true;
                }
            }
        } else {
            $this->find($user);
        }
    }
    
    public function find($user = null) {
        global $db;
        
        if ($user) {
            $sql = $db->prepare("SELECT u.*, ur.title AS rank_title, ur.color AS rank_color FROM `users` AS u LEFT JOIN `user_rank` AS ur on u.user_rank_id = ur.id WHERE u.username = '$user'");
            $data = $db->getResultsArray($sql);
            if (empty($data)) {
                $sql = $db->prepare("SELECT u.*, ur.title AS rank_title, ur.color AS rank_color FROM `users` AS u LEFT JOIN `user_rank` AS ur on u.user_rank_id = ur.id WHERE u.id = '$user'");
                $data = $db->getResultsArray($sql);
            }
            if (count($data)) {
                $data = $data[0];
                $data['permissions'] = unserialize($data['permissions']);
                $this->_data = $data;
                return true;
            }
        }
        return false;
    }
    
    /**
     * Create a new user
     * (Validation is handled on register page)
     */
    public function create($data = []) {
        global $db;
        
        $password = make_hash($data['password']);
        $perm = serialize($data['permissions']);
        $username = $data['username'];
        $rank = $data['user_rank_id'];
        $sql = $db->prepare("INSERT INTO arma_online.`users` (`username`, `password`, `permissions`, `user_rank_id`) VALUES ('$username', '$password', '$perm', '$rank');");
        $newID = $db->insert($sql);
        if (!$newID) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        add_message('Benutzer ' . $data['username'] . ' wurde erfolgreich erstellt', MSG_TYPE_SUCCESS);
        return $newID;
    }
    
    public function login($username = null, $password = null, $remember = false) {
        $user = $this->find($username);
        if ($user) {
            if (check_hash($password, $this->data()['password'])) {
                Session::put($this->_sessionName, $this->data()['id']);
                Session::put("timestamp", time());
                return true;
            }
        }
        return false;
    }
    
    public function logout() {
        Session::delete($this->_sessionName);
        $this->_isLoggedIn = false;
    }
    
    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }

    public function data() {
        return $this->_data;
    }
    
    public function username() {
        return $this->_data['username'];
    }
    
    public function rankname() {
        return $this->_data['rank_title'];
    }
    
   public function rankcolor() {
        return $this->_data['rank_color'];
    }
    
   public function rankid() {
        return $this->_data['user_rank_id'];
    }
    
    public function getBannedPlayers() {
        global $db;
        if ($this->_data['user_rank_id'] <= 2) {
            $query = $db->prepare("SELECT * FROM arma_main_server.`bans` WHERE `status`='true';");
        } else {
            $username = $this->_data['username'];
            $query = $db->prepare("SELECT * FROM arma_main_server.`bans` WHERE `von`='$username' AND `status`='true';");
        }
        $array = $db->getResultsArray($query);
        return $array;
    }
    
    public function getAllRanks() {
        global $db;

        $query = $db->prepare("SELECT * FROM arma_online.user_rank;");
        $array = $db->getResultsArray($query);
        return $array;
    }
    
    public function getAllUsers() {
        global $db;

        $query = $db->prepare("SELECT u.*,r.title FROM arma_online.users AS u LEFT JOIN arma_online.user_rank AS r ON r.id=u.user_rank_id;");
        $array = $db->getResultsArray($query);
        return $array;
    }
    
    public function hasPermision($perm) {
        if (in_array($perm,$this->_data['permissions'])) {
            return true;
        }
        return false;
    }
    
    public function updatePermissions($perm) {
        global $db;
        $perm = serialize($perm);
        $id = $this->_data['id'];
        $query = $db->prepare("UPDATE arma_online.users SET permissions='$perm' WHERE `id`='$id'");
        $error = $db->update($query);
        if (!$error) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $error;
    }
    
    public function isLoggedIn() {
        if (isset($this->_isLoggedIn)) {
            return $this->_isLoggedIn;
        } else {
            return false;
        }
    }
}