<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

$user = new User();
$user->logout();

session_destroy();

redirect(DE100_DOMAIN."login.php");