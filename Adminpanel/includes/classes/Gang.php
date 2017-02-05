<?php
class Gang {
    public function __construct($id = null) {
        global $db;
        
        if ($id) {
            $query = $db->prepare("SELECT * FROM arma_main_server.gang_system WHERE id='$id';");
            $data = $db->getResultsArray($query);

            if (count($data)) {
                $this->_data = $data[0];
            } else {
                $this->_data = [];
            }
        }
    }

    public function data() {
        return $this->_data;
    }

    public function getGangs()
    {
        global $db;
        $query = $db->prepare("SELECT * FROM arma_main_server.gang_system;");
        $data = $db->getResultsArray($query);

        return $data;
    }
    public function updateMembers($members)
    {
        global $db;
        $id = $this->_data['id'];
        $members = '"'.toArmaEscapedArray($members).'"';
        $query = $db->prepare("UPDATE `arma_main_server`.`gang_system` SET `members`='$members' WHERE `id`='$id';");
        $data = $db->update($query);
        if (!$data) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $data;
    }

    public function getComments()
    {
        global $db;
        $id = $this->_data['id'];
        $query = $db->prepare("SELECT gc.*,u.username AS author_name FROM gang_comments AS gc LEFT JOIN users AS u on gc.author_id = u.id WHERE gc.gang_id='$id';");
        $data = $db->getResultsArray($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        return $data;
    }

    public function addComment($text,$user_id)
    {
        global $db;
        $id = $this->_data['id'];
        $query = $db->prepare("INSERT INTO `arma_online`.`gang_comments` (`gang_id`, `author_id`, `text`, `date`) VALUES ('$id', '$user_id', '$text', NOW());");
        $data = $db->insert($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        add_message("Kommentar hinzugefügt", MSG_TYPE_SUCCESS);
        return $data;
    }

    public function removeComment($id,$authid)
    {
        global $db;
        $query = $db->prepare("DELETE FROM gang_comments WHERE id='$id' AND author_id='$authid';");
        $db->query($query);
        if ($db->getLastError()) {
            add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
        add_message("Kommentar gelöscht", MSG_TYPE_SUCCESS);
        return true;
    }
}