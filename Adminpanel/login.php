<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');
$user = new User();

if ($user->isLoggedIn()) {
    add_message("Du bist bereits eingeloggt", MSG_TYPE_ERROR);
    redirect(DE100_DOMAIN."index.php");
}

if (Input::has()) {
    
    if (Tracker::getLoginAttempts() >= MAX_LOGIN_ATTEMPT) {
        redirect(DE100_DOMAIN."login.php", MSG_EXCEED_MAX_LOGIN_ATTEMPTS, MSG_TYPE_ERROR);
    }
    
    Tracker::addTrack();
    
    $validate = new Validate();
    $validation = $validate->check($_POST, [
        'username' => [ 'required' => true ],
        'password' => [ 'required' => true ]
    ]);
    
    if ($validation->passed()) {
        $login = $user->login(Input::get('username'), Input::get('password'));
        if ($login) {
            add_message("Login erfolgreich.", MSG_TYPE_SUCCESS);
            redirect(DE100_DOMAIN."index.php");
        } else {
            add_message("Login failed.", MSG_TYPE_ERROR);
        }
        //$user->create($_POST);
        //die($user->find(Input::get('username')));
    } else {
        foreach ($validation->errors() as $error) {
            add_message($error, MSG_TYPE_ERROR);
        }
    }
}


$DE100_GLOBALS['content'] = "login";
$DE100_GLOBALS['title'] = "Login - " .DE100_SITE_NAME;
require(DIR_SITES . "login.php");
?>
