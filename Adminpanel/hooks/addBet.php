<?php 
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$article = new Auction(Input::get('id'));
$user = new User();
$pid = Input::get('pid');
$amt = Input::get('amnt');
if (!$user->isLoggedIn()) {
	die("-1");
}
if (!$article->data() || $amt <= 0 || $pid == $article->data()['seller'] || $article->data()['sold'] == 1) {
	die("0");
}

if ($user->onlineMoney() < $amt) {
	die("3");
}


$ret = $article->addBet($pid,$amt);

echo $ret;
?>