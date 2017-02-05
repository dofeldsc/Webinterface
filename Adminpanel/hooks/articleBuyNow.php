<?php 
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$article = new Auction(Input::get('id'));
$pid = Input::get('pid');
$user = new User();
if (!$user->isLoggedIn()) {
	die("-1");
}

if (!$article->data() || $pid == $article->data()['seller'] || $article->data()['sold'] == 1) {
	die("0");
}

if ($user->onlineMoney() < $article->data()['buynow']) {
	die("3");
}

$user->editOnlineMoney(-($article->data()['buynow']));

$ret = $article->buyNow($pid);

echo $ret;
?>