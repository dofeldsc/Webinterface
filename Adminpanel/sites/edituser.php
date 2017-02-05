<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
$target = new User(Input::get('id'));
if (!$target->data()) {
    redirect(DE100_DOMAIN,"Der Benutzer konnte nicht gefunden werden",MSG_TYPE_ERROR);
}

if (Input::get('action')) {
    switch(Input::get('action')){
        case 'del':
            if (!$user->hasPermision("UserDel")) {
                redirect(DE100_DOMAIN,"Dafür hast du nicht die Berechtigung",MSG_TYPE_ERROR);
            }
            add_message("Der Account von ". $target->data()['username'] ." wurde gelöscht.", MSG_TYPE_SUCCESS);
            $target->delete();
            break;
    }
    redirect(DIR_TO_SITES."viewusers");
}

$DE100_GLOBALS['content'] = "edituser";
$DE100_GLOBALS['title'] = "Benutzer - " .DE100_SITE_NAME;
$DE100_GLOBALS['permission'] = "UserEdit";
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
