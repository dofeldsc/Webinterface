<?php 
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if (!Input::get('itemInfo')) {
	die("0");
}
$itemInfo = json_decode(Input::get('itemInfo'));
if (Auction::onlineStatus($itemInfo->itemID) != 1) {
	die("0");
}

$ret = Auction::addAuction($itemInfo->itemID,$itemInfo->pid,$itemInfo->buyNow,$itemInfo->startBet,date("Y-m-d H:i:s", strtotime($itemInfo->expireDate)));
echo $ret;
?>