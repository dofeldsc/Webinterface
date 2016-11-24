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
    /*global $db;

    if (Session::exists('user')) {
        print_r($_SESSION);
        $userID = $_SESSION['user'];
        $query = $db->prepare("SELECT id FROM users WHERE id=%d", $userID);
        $row = $db->getRow($query);

        if (!$row) {
            $_SESSION['user'] = null;
            unset($_SESSION['user']);
            return false;
        }
        return $row['id'];
    }*/
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
        redirect(DE100_DOMAIN."index.php", "Fehler beim lesen der Benutzerdaten", MSG_TYPE_ERROR);
    else {
        $query = $db->prepare("SELECT UA.role FROM users AS U LEFT JOIN user_roles AS UA ON UA.id = U.user_role WHERE U.id=%d", $userID);
        $userRole = $db->getVar($query);
    }
    
    if ($userRole == $roleID)
        return true;
    else
        return false;
}

function is_admin() {
    $user = new User();
    if (check_user_role(USER_ROLE_ADMIN, $user->data()['id']))
        return true;
        
    return false;
}

function is_teacher() {
    $user = new User();
    // Return also for admin true...
    if (check_user_role(USER_ROLE_MOD, $user->data()['id']) || check_user_role(USER_ROLE_ADMIN, $user->data()['id']))
        return true;
        
    return false;
}

function is_student() {
    $user = new User();
    if (check_user_role(USER_ROLE_STUDENT, $user->data()['id']))
        return true;
    
    return false;
}

function is_permitted() {
    if (is_student()) {
        add_message(MSG_NOT_PERMITTED, MSG_TYPE_ERROR);
        redirect(DE100_DOMAIN."index.php");
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
    $input = str_replace("\"", "", $input);
    $input = str_replace("`", "\"", $input);
    $input = json_decode($input); 
    return $input;
}

function toArmaEscapedArray($input) {
    $str = '"[';
    $numItems = count($input);
    $i = 0;
    foreach ($input as $value) {
        if (++$i === $numItems) {
            $str = $str.'[`'. $value[0] .'`,'. $value[1] .']';
        } else {
            $str = $str.'[`'. $value[0] .'`,'. $value[1] .'],';
        }
        
    }
    return $str.']"';
}

function getPermissionName($var) {
    global $PERMISSIONS_CONFIG;
    if (isset($PERMISSIONS_CONFIG[$var])) {
        return $PERMISSIONS_CONFIG[$var][1];
    } else {
        return $var;
    }
}
