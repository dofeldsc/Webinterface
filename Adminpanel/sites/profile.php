<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();

if (Input::has()) {
    $validate = new Validate();
    $validation = $validate->check($_POST, [
    	'SteamID' => [ 'required' => true ],
    	'oldpass' => [ 'required' => true, 'check_hash' => $user->data()['password'] ],
        'password_new' => [ 'required' => true,'min' => 6 ],
        'password_new_again' => [ 'required' => true, 'matches' => 'password_new' ]
    ]);
    
    if ($validation->passed()) {

    } else {
        foreach ($validation->errors() as $error) {
            add_message($error, MSG_TYPE_ERROR);
        }
    }
}

$DE100_GLOBALS['content'] = "profile";
$DE100_GLOBALS['title'] = "Benutzer - " .DE100_SITE_NAME;
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
