<?php
    require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
    $user = new User();
    if (!$user->hasPermision("UserEdit") || !$user->isLoggedIn()) {
        die();
    }
    $id = Input::get('id');
    $perm = Input::get('perm');
    $target = new User($id);
    $tperm = $target->data()["permissions"];
    if (in_array($perm,$tperm)) {
        unset($tperm[array_search($perm,$tperm)]);
    } else {
        array_push($tperm,$perm);
    }
    
    $target->updatePermissions($tperm);