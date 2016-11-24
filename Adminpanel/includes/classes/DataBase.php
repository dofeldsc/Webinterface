<?php

/**
 * DataBase using MySQLi
 */
class DataBase {
    public $link;
    public $last_query;
    public $last_error;

    public function __construct($host, $username, $pass, $database) {
        $this->link = null;
        $this->last_query = null;
        $this->last_error = null;

        $link = mysqli_connect($host, $username, $pass, $database);
        if (mysqli_connect_errno()) {
            echo "Fehler beim Verbinden mit MySQL: (Error " . mysqli_connect_errno() . ") " . mysqli_connect_error();
            exit(0);
        }
        if (!$link->set_charset('utf8')) {
            printf("Error loading character set utf8: %s\n", $link->error);
            exit(0);
        }
        $this->link = $link;
    }

    /**
     * Query Ergebnis als Array zurückgeben
     */
    public function getResultsArray($query, $key = null, $type = 'ASSOC'){
        $res = mysqli_query($this->link, $query);
        $this->last_query = $query;
        $this->last_error = null;
        if(mysqli_errno($this->link)){
            $this->setLastError();
            return null;
        }
        $rows = [];
        if($res){
            $resultType = MYSQLI_BOTH;
            switch($type){
                case 'ASSOC':
                case 'OBJ':
                    $resultType = MYSQLI_ASSOC;
                    break;
                case 'NUM':
                    $resultType = MYSQLI_NUM;
                    break;
                case 'BOTH':
                default:
                    $resultType = MYSQLI_BOTH;
                    break;
            }
            while($row = mysqli_fetch_array($res, $resultType)){
                if($type != 'OBJ')
                    $rows[] = $row;else{
                    //Convert array to object
                    $rowObj = new stdClass();
                    foreach($row as $k => $v){
                        $rowObj->$k = $v;
                    }
                    $rows[] = $rowObj;
                }
            }
            mysqli_free_result($res);
        }
        if($key != null && count($rows) > 0 && isset($rows[0][$key])){
            //Change the array to $key indexed array
            $result = [];
            foreach($rows as $row){
                $result[$row[$key]] = $row;
            }
            $rows = $result;
        }
        return $rows;
    }

    /**
     * Wie getResultsArray nur gibt diese Funktion nur eine Reihe zurück
     */
    public function getRow($query, $type = 'ASSOC'){
        $res = mysqli_query($this->link, $query);
        $this->last_query = $query;
        $this->last_error = null;
        if(mysqli_errno($this->link)){
            $this->setLastError();
            return null;
        }
        $row = [];
        if($res){
            $resultType = MYSQLI_BOTH;
            switch($type){
                case 'ASSOC':
                case 'OBJ':
                    $resultType = MYSQLI_ASSOC;
                    break;
                case 'NUM':
                    $resultType = MYSQLI_NUM;
                    break;
                case 'BOTH':
                default:
                    $resultType = MYSQLI_BOTH;
                    break;
            }
            if($row = mysqli_fetch_array($res, $resultType)){
                if($type == 'OBJ'){
                    //Convert array to object
                    $rowObj = new stdClass();
                    foreach($row as $k => $v){
                        $rowObj->$k = $v;
                    }
                    $row = $rowObj;
                }
            }
            mysqli_free_result($res);
        }
        return $row;
    }

    /**
     * Gibt einen einen Wert von der Query wieder
     */
    public function getVar($query){
        $res = mysqli_query($this->link, $query);
        $this->last_query = $query;
        $this->last_error = null;
        if(mysqli_errno($this->link)){
            $this->setLastError();
            return null;
        }
        $var = null;
        if($res){
            if($row = mysqli_fetch_array($res, MYSQLI_NUM)){
                $var = $row[0];
            }
            mysqli_free_result($res);
        }
        return $var;
    }

    /**
     * Setzt den zuletzt entstandenen Fehler sofern einer enstanden ist...
     */
    function setLastError(){
        $this->last_error = "Query Error" . mysqli_errno($this->link) . ": " . mysqli_error($this->link);
    }
    /**
     * Gibt diesen Fehler zurück
     */
    public function getLastError(){
        if(mysqli_errno($this->link)){
            return mysqli_error($this->link);
        }else{
            return null;
        }
    }
    
    /**
     * Input escapen um sql injection zu unterbinden
     */
    public function escapeInput(&$input, $html_encode = true){
        $converts = ['<' => '&lt;', '>' => '&gt;', "'" => '&#039;', '"' => '&quot;'];
        if(is_array($input)){
            $escaped = [];
            foreach($input as $k => $v){
                if($html_encode)
                    $v = str_replace(array_keys($converts), array_values($converts), $v);
                $escaped[$k] = mysqli_real_escape_string($this->link, $v);
            }
        }else{
            if($html_encode)
                $input = str_replace(array_keys($converts), array_values($converts), $input);
            $escaped = mysqli_real_escape_string($this->link, $input);
        }
        $input = $escaped;
        return $escaped;
    }
    
    /**
     * SQL Query vorbereiten für eine sichere Ausführung
     * %d (int)
     * %f (float)
     * %s (string)
     */
    public function prepare($query = null)
    {
        if(is_null($query))
            return;
        $args = func_get_args();
        array_shift($args);
        if(isset($args[0]) && is_array($args[0]))
            $args = $args[0];
        $query = str_replace("'%s'", '%s', $query);
        $query = str_replace('"%s"', '%s', $query);
        $query = preg_replace('|(?<!%)%s|', "'%s'", $query);
        array_walk($args, [&$this, 'escapeInput']);
        return @vsprintf($query, $args);
    }

    /**
     * Query zum einfügen von Daten in die Datenbank
     * Gibt immer die erstellte ID zurück
     */
    public function insert($query){
        $this->last_query = $query;
        $this->last_error = null;
        $res = mysqli_query($this->link, $query);
        if($res){
            $newId = mysqli_insert_id($this->link);
            return $newId;
        }else{
            $this->setLastError();
            return null;
        }
    }

    /**
     * Gibt die zuletzt hinzugefügte ID zurück
     */
    public function getLastInsertId(){
        return mysqli_insert_id($this->link);
    }
    /**
     * Wie insert + fügt ein ganzes Array hinzu
     */
    public function insertFromArray($table, $data){
        $query = [];
        $query_v = [];
        foreach($data as $k => $v){
            $query[] = "`" . $k . "`";
            $query_v[] = "'" . $this->escapeInput($v) . "'";
        }
        $query = "INSERT INTO " . $table . "(" . implode(", ", $query) . ")VALUES(" . implode(", ", $query_v) . ")";
        return $this->insert($query);
    }
    /**
     * Einfache query...
     */
    public function query($query){
        $this->last_query = $query;
        $res = mysqli_query($this->link, $query);
        if(!$res){
            $this->setLastError();
            return false;
        }else{
            return true;
        }
    }
    
    /**
     * Zum aktualisieren von vorhandenen Einträgen
     */
    public function update($query){
        $this->last_query = $query;
        $this->last_error = null;
        $res = mysqli_query($this->link, $query);
        if($res){
            return true;
        }else{
            $this->setLastError();
            return null;
        }
    }
    
    /**
     * Wie udapte + array
     */
    public function updateFromArray($table, $data, $where) {
        $query_v = [];
        $query_w = [];
        foreach($data as $k => $v){
            $query_v[] = "`" . $k . "`='" . $this->escapeInput($v) . "'";
        }
        foreach($where as $k => $v){
            $query_w[] = "`" . $k . "`='" . $this->escapeInput($v) . "'";
        }
        $query = "UPDATE " . $table . " SET " . implode(", ", $query_v) . " WHERE 1=1 AND (" . implode(" AND ", $query_w) . ")";
        return $this->update($query);
    }
    
    /**
     * Zum löschen von datensätzen
     */
    public function delete($table, $where) {
        return $this->query("DELETE FROM $table WHERE $where");
    }
}