<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
$article = new Auction(Input::get('id'));
$articleData = $article->data();
if (!$articleData) {
    redirect(DE100_DOMAIN,"Der Artikle konnte nicht gefunden werden",MSG_TYPE_ERROR);
}

$DE100_GLOBALS['content'] = "article";
$DE100_GLOBALS['title'] = "Auktionshaus - " .DE100_SITE_NAME;
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>