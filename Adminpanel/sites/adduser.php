<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
if (Input::has()) {
    $validate = new Validate();
    $validation = $validate->check($_POST, [
        'AddUser' => [ 'required' => true , 'unique' => 'users'],
        'AddPass' => [ 'required' => true ],
        'AddRank' => [ 'required' => true ]
    ]);
    
    if ($validation->passed()) {
        $user->create([
            'username' => Input::get('AddUser'),
            'password' => Input::get('AddPass'),
            'user_rank_id' => Input::get('AddRank'),
            'permissions' => (json_decode(Input::get('AddPerm')))
        ]);
        
    } else {
        foreach ($validation->errors() as $error) {
            add_message($error, MSG_TYPE_ERROR);
        }
    }
}

$DE100_GLOBALS['content'] = "adduser";
$DE100_GLOBALS['title'] = "Benutzer hinzufügen - " .DE100_SITE_NAME;
$DE100_GLOBALS['permission'] = "UserAdd";
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
