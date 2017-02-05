<?php

class User {

        private $_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn;

    public function __construct($user = null) {
        global $db;
        
        $this->_sessionName = "user_id";
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
            $sql = $db->prepare("SELECT u.*, ur.title AS rank_title, ur.color AS rank_color FROM `users` AS u LEFT JOIN `user_rank` AS ur on u.user_rank_id = ur.id WHERE u.player_id = '$user'");
            $data = $db->getResultsArray($sql);
            if (empty($data)) {
                $sql = $db->prepare("SELECT u.*, ur.title AS rank_title, ur.color AS rank_color FROM `users` AS u LEFT JOIN `user_rank` AS ur on u.user_rank_id = ur.id WHERE u.id = '$user'");
                $data = $db->getResultsArray($sql);
            }
            if (empty($data)) {
                return false;
            }

            if (count($data)) {
                $data = $data[0];
                $url = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".STEAMAPIKEY."&steamids=".$data['player_id']); 
                $content = json_decode($url, true);
                $data['steam_name'] = $content['response']['players'][0]['personaname'];
                $data['steam_avatar'] = $content['response']['players'][0]['avatarfull'];
                $data['steam_personastate'] = $content['response']['players'][0]['personastate'];
                if (isset($content['response']['players'][0]['realname'])) { 
                    $data['steam_realname'] = $content['response']['players'][0]['realname'];
                   } else {
                    $data['steam_realname'] = "Unbekannt";
                }
                $data['permissions'] = unserialize($data['permissions']);
                $this->_data = $data;
            }
            return true;
        }
        return false;
    }
    
    public function delete()
    {
        global $db;
        $db->delete('`arma_online`.`users`','id='.$this->_data['id']);
    }

    /**
     * Create a new user
     * (Validation is handled on register page)
     */
    public function create($data = []) {
        global $db;
        
        $player_id = $data['player_id'];
        $perm = serialize($data['permissions']);
        $username = $data['username'];
        $rank = $data['user_rank_id'];
        $sql = $db->prepare("INSERT INTO arma_online.`users` (`username`, `player_id`, `permissions`, `user_rank_id`) VALUES ('$username', '$player_id', '$perm', '$rank');");
        $newID = $db->insert($sql);
        if (!$newID) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        $user = $this->find($player_id);
        if ($user) {
            Session::put($this->_sessionName, $this->data()['id']);
            Session::put("timestamp", time());
            return true;
        }
        return false;
    }
    
    public function login($username = null) {
        $user = $this->find($username);
        if ($user) {
            Session::put($this->_sessionName, $this->data()['id']);
            Session::put("timestamp", time());
            return true;
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
        if ($this->_data) {
            return $this->_data;
        } else {
            return false;
        }
        
    }

    public function is_player() {
        $data = $this->data();
        if (!$data) {
            return true;
        }
        
        if ($data['user_rank_id'] > 4) {
                return true;
            }    
        return false;
    }

    public function username($steamName=false) {
        if ($steamName) {
            if ($this->_data['steam_name']) {
                return $this->_data['steam_name'];
            }
        } else {
            if ($this->_data['username']) {
                return $this->_data['username'];
            }
        }
        return "Gast";
    }
    
    public function rankname() {
        if ($this->_data['rank_title']) {
            return $this->_data['rank_title'];
        } else {
            return "Gast";
        }
    }
    
   public function rankcolor() {
        if ($this->_data['rank_color']) {
            return $this->_data['rank_color'];
        } else {
            return "gray";
        }
    }

    public function steamID() {
        return $this->_data['player_id'];
    }
    
    public function rankid() {
        return $this->_data['user_rank_id'];
    }

    public function onlineMoney() {
        return $this->_data['online_bank'];
    }

    public function id() {
        return $this->_data['id'];
    }

    public function editOnlineMoney($amm = 0) {
        global $db;
        $id = $this->_data['id'];
        $query = $db->prepare("UPDATE `arma_online`.`users` SET `online_bank`=`online_bank`+'$amm' WHERE `id`='$id';");
        $error = $db->update($query);
        if (!$error) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        $this->_data['online_bank'] += $amm;
        return $this->_data['online_bank'];
    }
    
    public function getBannedPlayers() {
        global $db;
        if (in_array('BanUnbanAll',$this->_data['permissions'])) {
            $query = $db->prepare("SELECT * FROM arma_main_server.`bans` WHERE `status`='true' ORDER BY id DESC;");
        } else {
            $username = $this->_data['username'];
            $query = $db->prepare("SELECT * FROM arma_main_server.`bans` WHERE `von`='$username' AND `status`='true' ORDER BY id DESC;");
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
        if (!$this->_data) {
            return false;
        }
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

    public function updateSteamID($steamID)
    {
        global $db;
        $id = $this->_data['id'];
        $this->_data['player_id'] = $steamID;
        $query = $db->prepare("UPDATE arma_online.users SET player_id='$steamID' WHERE `id`='$id'");
        $error = $db->update($query);
        if (!$error) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $error;
    }

    public function updatePassword($newPW)
    {
        global $db;

        $newPW = make_hash($newPW);
        $id = $this->_data['id'];
        $this->_data['password'] = $newPW;
        $query = $db->prepare("UPDATE arma_online.users SET password='$newPW' WHERE `id`='$id'");
        $error = $db->update($query);
        if (!$error) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $error;
    }

    public function updateAvatar($file)
    {
        global $db;
        $userID = $this->_data['id'];
        $query = $db->prepare("SELECT username,avatar_id FROM arma_online.users WHERE id='$userID';");
        $array = $db->getResultsArray($query);
        $array = $array[0];

        $userpic = $array['username'].$array['avatar_id'].".png";
        if (file_exists(DIR_IMGS.'user_pics/'.$userpic)) {
            unlink(DIR_IMGS.'user_pics/'.$userpic);
        }

        $imgFile = $file['name'];
        $tmp_dir = $file['tmp_name'];
        $imgSize = $file['size'];
        $time = time();

        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
        $userpic = $this->_data['username'].$time.".".$imgExt;
        move_uploaded_file($tmp_dir,DIR_IMGS.'user_pics/'.$userpic);

        $id = $this->_data['id'];
        $query = $db->prepare("UPDATE arma_online.users SET avatar_id='$time' WHERE `id`='$id'");
        $error = $db->update($query);
        if (!$error) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $error;
    }

    public function getAvatar($userID = '')
    {
        if ($userID == '') {
            if ($this->_data['steam_avatar']) {
                return $this->_data['steam_avatar'];
            } else {
                return (DIR_TO_IMG.'default_avatar.png');
            }
        } else {
            $url = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".STEAMAPIKEY."&steamids=".$this->getPlayerID($userID)); 
            $content = json_decode($url, true);
            return $content['response']['players'][0]['avatarfull'];
        }
    }

    public static function getPlayerID($userID='')
    {
        global $db;
        $query = $db->prepare("SELECT player_id FROM `arma_online`.`users` WHERE `id`='$userID';");
        $id = $db->getVar($query);
        if (!$id) {
            return false;
        }
        return $id;
    }

    public function topBans()
    {
        global $db;

        $query = $db->prepare("SELECT count(*) AS counter,von FROM arma_main_server.bans GROUP BY von ORDER BY counter DESC LIMIT 10;");
        $data = $db->getResultsArray($query);
        if (!$data) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $data;
    }

    public function retrieveArticle()
    {
        global $db;
        $pid = $this->steamID();
        $query = $db->prepare("SELECT `a`.*,`i`.`class`,(SELECT `name` FROM `arma_main_server`.`players` AS `p` WHERE `p`.`playerid` = `a`.`seller`) AS `owner_name`,(SELECT `name` FROM `arma_main_server`.`players` AS `p` WHERE `p`.`playerid` = `a`.`currentHolder`) AS `currentHolder_name` FROM `arma_online`.`auctions` AS `a` LEFT JOIN `arma_online`.`items` AS `i` ON `i`.`id`=`a`.`itemid` WHERE TIMEDIFF(NOW(),`a`.`expireDate`) >= 0 AND '$pid' IN (`a`.`seller`,`a`.`currentHolder`) AND `a`.`sold` = '0';");
        $data = $db->getResultsArray($query);
        if (count($data) == 0) {
            return 1;
        }
        if (!$data) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return 0;
        }
        $msg = [];
        foreach ($data as $set) {
            $aid = $set['id'];
            $iid = $set['itemid'];
            $currentHolder = $set['currentHolder'];
            $seller = $set['seller'];
            $extra = "";
            if ($seller == $pid) {
                if ($currentHolder) {
                    $target = new User($currentHolder);
                    $this->editOnlineMoney($set['currentPrice']);
                    $target->editOnlineMoney(-($set['currentPrice']));
                    array_push($msg,[$set['currentHolder_name'].' hat deine '.Player::getItemName($set['class']).' für $'.number_format($set['currentPrice'],0, '.', ",").' gekauft.<br>Link zur Auktion: <a target="_blank" href="'.DIR_TO_SITES.'article?id='.$set['id'].'">Link</a>','custom']);
                    Notify::addNotify($this->id(),$set['currentHolder_name'].' hat deine '.Player::getItemName($set['class']).' für $'.number_format($set['currentPrice'],0, '.', ",").' gekauft.<br>Link zur Auktion: <a target="_blank" href="'.DIR_TO_SITES.'article?id='.$set['id'].'">Link</a>',0,1);
                    Notify::addNotify($target->id(),'Du hast eine '.Player::getItemName($set['class']).' von '.$set['owner_name'].' für $'.number_format($set['currentPrice'],0, '.', ",").' ersteigert.<br>Link zur Auktion: <a target="_blank" href="'.DIR_TO_SITES.'article?id='.$set['id'].'">Link</a>');
                } else {
                    array_push($msg,['Deine '.Player::getItemName($set['class']).' wurde nicht verkauft und wurde wieder in dein Inventar transferiert.<br>Link zur Auktion: <a target="_blank" href="'.DIR_TO_SITES.'article?id='.$set['id'].'">Link</a>','error']);
                    Notify::addNotify($this->id(),'Deine '.Player::getItemName($set['class']).' wurde nicht verkauft und wurde wieder in dein Inventar transferiert.<br>Link zur Auktion: <a target="_blank" href="'.DIR_TO_SITES.'article?id='.$set['id'].'">Link</a>',0,1);
                }
            } else {
                $target = new User($seller);
                $this->editOnlineMoney(-($set['currentPrice']));
                $target->editOnlineMoney($set['currentPrice']);
                array_push($msg,['Du hast eine '.Player::getItemName($set['class']).' von '.$set['owner_name'].' für $'.number_format($set['currentPrice'],0, '.', ",").' ersteigert.<br>Link zur Auktion: <a target="_blank" href="'.DIR_TO_SITES.'article?id='.$set['id'].'">Link</a>','success']);
                Notify::addNotify($target->id(),$set['currentHolder_name'].' hat deine '.Player::getItemName($set['class']).' für $'.number_format($set['currentPrice'],0, '.', ",").' gekauft.<br>Link zur Auktion: <a target="_blank" href="'.DIR_TO_SITES.'article?id='.$set['id'].'">Link</a>');
                Notify::addNotify($this->id(),'Du hast eine '.Player::getItemName($set['class']).' von '.$set['owner_name'].' für $'.number_format($set['currentPrice'],0, '.', ",").' ersteigert.<br>Link zur Auktion: <a target="_blank" href="'.DIR_TO_SITES.'article?id='.$set['id'].'">Link</a>',0,1);
            }
            
            $query = $db->prepare("UPDATE `arma_online`.`auctions` SET `sold`='1' ".$extra." WHERE `id`='$aid';");
            $db->update($query);
            if ($currentHolder) {
                $query = $db->prepare("UPDATE `arma_online`.`items` SET `owner`='$currentHolder', `isOnline`='1' WHERE `id`='$iid';");
                $db->update($query);
            }
        }
        return $msg;
    }
}