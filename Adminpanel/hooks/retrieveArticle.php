<?php 
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
if (!$user->isLoggedIn()) {
	die("0");
}

echo $user->onlineMoney();
?>