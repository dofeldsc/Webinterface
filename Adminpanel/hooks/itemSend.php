<?php
    require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

    $items = json_decode(Input::get('items'));
    if (!$items) {
        die("0");
    }
    $query = "(";
    foreach ($items as $c => $item) {
        if ($c < count($items)-1) {
            $query = $query.$item[0].",";
        } else {
            $query = $query.$item[0].")";
        }
    }
    Player::sendItemsToGame($query);
    die("1");