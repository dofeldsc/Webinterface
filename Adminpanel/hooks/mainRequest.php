<?php 
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
if (!$user->isLoggedIn()) {
	die("0");
}

$lnID = Input::get('lastNotif');

$ret = [];
$ret['onlineBank'] = $user->onlineMoney();
$ret['notif'] = array_reverse(Notify::get($user->id(),false,0,$lnID));
$ret['lastNotif'] = Notify::getLastID($user->id());
echo json_encode($ret);
?>