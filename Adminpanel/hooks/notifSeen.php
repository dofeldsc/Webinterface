<?php 
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$id = Input::get('id');
$user = new User();
if (!$user->isLoggedIn()) {
	die();
}

if (!$id ||$id <= 0) {
	die();
}

Notify::seen($id);
?>