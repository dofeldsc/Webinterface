<?php
require(dirname(dirname(dirname(__FILE__))) . '/includes/bootstrap.php');

if (!Input::get('pid')) {
    die('{"error":"no ID was given"}');
}
$player = new Player(Input::get('pid'));

echo json_encode(
    $player->getPlayerLogs($_GET)
);