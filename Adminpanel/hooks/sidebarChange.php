<?php
    require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
    $user = new User();
    if (!$user->isLoggedIn()) {
        die();
    }
    if (isset($_COOKIE['sideBarCollpased'])) {
		setcookie('sideBarCollpased',"",time()-3600,'/');
    } else {
		setcookie('sideBarCollpased',"Collpased",time()+(86400 * 30),'/');
    }