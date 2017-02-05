<?php 
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$article = new Auction(Input::get('id'));
if (!$article->data()) {
	die("false");
}

$betHistory = $article->getBetHistory(Input::get('betId'));
$retarr = $article->data();
$retarr['betHistory'] = $betHistory;
echo json_encode($retarr);
?>