<?php
// Common functions used on the whole site

function enqueue_javascript($script, $is_absolute_path = false, $is_footer = true, $position = null) {
    global $DE100_GLOBALS;
    
    if (!$is_absolute_path)
        $script = DIR_TO_JS . $script;
    
    // Check if script is already added or not...    
    foreach ($DE100_GLOBALS['javascripts'] as $item) {
        if ($item['src'] == $script)
            return;
    }
    
    if ($position === null || $position >= count($DE100_GLOBALS['javascripts'])) {
        array_push($DE100_GLOBALS['javascripts'], ['src' => $script, 'is_footer' => $is_footer]);
    } else {
        $js = [];
        for ($i = 0; $i < count($DE100_GLOBALS['javascripts']); $i++) {
            if ($i == $position) {
                $js[] = ['src' => $script, 'is_footer' => $is_footer];
            }
            $js[] = $DE100_GLOBALS['javascripts'][$i];
        }
        $DE100_GLOBALS['javascripts'] = $js;
    }
}

function enqueue_stylesheet($stylesheet, $is_absolute_path = false, $position = null) {
    global $DE100_GLOBALS;
    
    if (!$is_absolute_path)
        $stylesheet = DIR_TO_CSS . $stylesheet;
        
    if($position === null || $position >= count($DE100_GLOBALS['stylesheets'])) {
        array_push($DE100_GLOBALS['stylesheets'], $stylesheet);
    } else {
        $sh = [];
        for($i = 0; $i < count($DE100_GLOBALS['stylesheets']); $i++) {
            if($i == $position)
                $sh[] = $stylesheet;
            $sh[] = $DE100_GLOBALS['stylesheets'][$i];
        }
        $DE100_GLOBALS['stylesheets'] = $sh;
    }
}

function render_javascripts($is_footer = true) {
    global $DE100_GLOBALS;
    
    if (isset($DE100_GLOBALS['javascripts'])) {
        if (!is_array($DE100_GLOBALS['javascripts']))
            $DE100_GLOBALS['javascripts'] = [$DE100_GLOBALS['javascripts']];
        
        foreach ($DE100_GLOBALS['javascripts'] as $item) {
            if ($item['is_footer'] != $is_footer)
                continue;
            
            echo '<script type="text/javascript" src="' . $item['src'] . '"></script>' . PHP_EOL;
        }
    }
}

function render_stylesheets() {
    global $DE100_GLOBALS;
    
    if (isset($DE100_GLOBALS['stylesheets'])) {
        if (!is_array($DE100_GLOBALS['stylesheets']))
            $DE100_GLOBALS['stylesheets'] = [$DE100_GLOBALS['stylesheets']];
        $DE100_GLOBALS['stylesheets'] = array_unique($DE100_GLOBALS['stylesheets']);
        
        foreach ($DE100_GLOBALS['stylesheets'] as $src) {
            echo '<link rel="stylesheet" type="text/css" href="' . $src . '" />' . PHP_EOL;
        }
    }
}

function generate_random_string($length = 8, $complicated = false){
    $alphabets = 'abcdefghijklmnopqrstuvwABCDEFGHIJKLMKOPQRSTUVW1234567890';
    if($complicated)
        $alphabets .= '!@#$%^&*()';

    $str = '';
    for($i = 0; $i < $length; $i++) {
        $str .= $alphabets[mt_rand(0, strlen($alphabets) - 1)];
    }
    return $str;
}

function get_form_token($forceNew = false) {
    $token = isset($_SESSION['form.token']) ? $_SESSION['form.token'] : null;
    
    if ($token === null || $forceNew) {
        $token = generate_random_string(12);
        $session_name = session_name();
        $token = md5($token . $session_name);
        $_SESSION['form.token'] = $token;
    }
    
    return $token;
}

function render_form_token($isReturn = false) {
    $html = '<input type="hidden" name="' . get_form_token() . '" value="1" />';
    
    if ($isReturn)
        return $html;
    else
        echo $html;
}

function check_form_token($method = 'post') {
    $token = get_form_token();
    if ($method == 'post') {
        if (Input::get($token) == 1)
            return true;
    } else if ($method == 'get') {
        if (Input::get($token) == 1)
            return true;
    } else if ($method == 'request') {
        if (isset($_REQUEST[$token]) && $_REQUEST[$token] == 1)
            return true;
    }
    return false;
}

/**
 * Redirect to url
 * Set message if $msg is not null
 */
function redirect($url, $msg = null, $msg_type = MSG_TYPE_SUCCESS) {
    if ($msg)
        add_message($msg, $msg_type);
    header("Location: " . $url);
    exit;
}

/**
 * Save message to session
 */
function add_message($msg, $msg_type = MSG_TYPE_SUCCESS) {
    if (!isset($_SESSION['message']))
        $_SESSION['message'] = [];
    $_SESSION['message'][] = ['type' => $msg_type, 'message' => htmlentities($msg, ENT_QUOTES)];
}

function add_notify($msg, $msg_type = 'success', $timeout = 5) {
    if (!isset($_SESSION['notifications']))
        $_SESSION['notifications'] = [];
    $_SESSION['notifications'][] = ['type' => $msg_type, 'timeout' => $timeout , 'message' => $msg];
}

/**
 * Advanced check if value is null or not
 */
function not_null($value) {
    if (is_array($value)) {
        if (sizeof($value) > 0)
            return true;
        else
            return false;
    } else {
        if ((is_string($value) || is_int($value)) && ($value != '') && (strlen(trim($value)) > 0))
            return true;
        else
            return false;
    }
}

/**
 * Render messages from session
 */
function render_messages() {
    if (isset($_SESSION['message']) && not_null($_SESSION['message'])) {
        for ($i = 0; $i < sizeof($_SESSION['message']); $i++) {
            switch ($_SESSION['message'][$i]['type']) {
                case MSG_TYPE_SUCCESS:
                    echo '<p class="alert alert-success" role="alert">' . $_SESSION['message'][$i]['message'] . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></p>';
                    break;
                case MSG_TYPE_ERROR:
                    echo '<p class="alert alert-danger" role="alert">' . $_SESSION['message'][$i]['message'] . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></p>';
                    break;
            }
        }
        unset($_SESSION['message']);
    }
}

function escape($string) {
    return htmlentities(strip_tags($string), ENT_QUOTES, 'UTF-8');
}

function is_logged_in() {
    $user = new User();
    return $user->isLoggedIn();
}

/**
 * Hash for users
 */
function make_hash($value) {
    $cost = 10;
    $hash = password_hash($value, PASSWORD_BCRYPT, ['cost' => $cost]);
    
    if ($hash === false) {
        throw new RuntimeException("Bcrypt hashing not supported.");
    }
    
    return $hash;
}

function check_hash($value, $hashedValue) {
    if (strlen($hashedValue) === 0) {
        return false;
    }
    
    return password_verify($value, $hashedValue);
}

/** User roles **/
function check_user_role($roleID, $userID = null) {
    global $db;

    if (!$userID)
        redirect(DE100_DOMAIN, "Fehler beim lesen der Benutzerdaten", MSG_TYPE_ERROR);
    else {
        $query = $db->prepare("SELECT UA.role FROM users AS U LEFT JOIN user_roles AS UA ON UA.id = U.user_role WHERE U.id=%d", $userID);
        $userRole = $db->getVar($query);
    }
    
    if ($userRole == $roleID)
        return true;
    else
        return false;
}

function is_permitted() {
    if (is_student()) {
        add_message(MSG_NOT_PERMITTED, MSG_TYPE_ERROR);
        redirect(DE100_DOMAIN);
    }
}

function yesNo($number) {
    if ($number == 1) {
        return "Ja";
    } else {
        return "Nein";
    }
}

function toPhpArray($input) {
    if (!$input) {
        return [];
    }
    $input = str_replace("\"", "", $input);
    $input = str_replace("`", "\"", $input);
    $input = json_decode($input); 
    return $input;
}

function toArmaEscapedArray($input) {
    $str = '[';
    $numItems = count($input);
    $i = 0;
    foreach ($input as $value) {
        if (++$i === $numItems) {
            if (is_array($value)) {
                $str .= toArmaEscapedArray($value);
            } else {
                if (is_string($value)) {
                    $str .= '`'.$value.'`';
                } else {
                    $str .= $value;
                }
            }
        } else {
            if (is_array($value)) {
                $str .= toArmaEscapedArray($value).',';
            } else {
                if (is_string($value)) {
                    $str .= '`'.$value.'`,';
                } else {
                    $str .= $value.',';
                }
            }
        }
    }
    return $str.']';
}

function getPermissionName($var) {
    global $PERMISSIONS_CONFIG;
    if (isset($PERMISSIONS_CONFIG[$var])) {
        return $PERMISSIONS_CONFIG[$var];
    } else {
        return $var;
    }
}

function toDate($number){
    if ($number < 0) {
        return "Permanent";
    }
    $number = str_split($number);
    $year = implode(array_slice($number,0,4));
    $month = implode(array_slice($number, 4,2));
    $day = implode(array_slice($number,6,2));
    $hr = implode(array_slice($number,8,2));
    $min = implode(array_slice($number,10,2));
    
    return $day.".".$month.".".$year." ".$hr.":".$min;
}

function make_links_clickable($text){
    return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1" target="_blank">$1</a>', $text);
}

function formatBytes($bytes, $precision = 2) {
    $unit = ["B", "KB", "MB", "GB"];
    $exp = floor(log($bytes, 1024)) | 0;
    return round($bytes / (pow(1024, $exp)), $precision).$unit[$exp];
}


function dateDifference($date_1)
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create();
    
    $interval = date_diff($datetime1, $datetime2);
    if ($interval->d > 0) {
        $se = ($interval->d > 1) ? 'Tagen' : 'Tag';
        return $interval->format('vor %d '.$se);
    }

    if ($interval->h > 0) {
        $se = ($interval->h > 1) ? 'Stunden' : 'Stunde';
        return $interval->format('vor %h Stunden');
    }

    if ($interval->i > 0) {
        $se = ($interval->i > 1) ? 'Minuten' : 'Minute';
        return $interval->format('vor %i Minuten');
    }
    return $interval->format('vor %s Sekunden');
    
}