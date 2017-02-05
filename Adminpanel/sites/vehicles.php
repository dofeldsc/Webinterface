<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
$vehicle = new Vehicle();

if (Input::get('action')) {
    switch(Input::get('action')){
        case 'reset':
            if (!$user->hasPermision("VehicleReset") && !$user->hasPermision("VehicleResetAdv")) {
                redirect(DE100_DOMAIN,"Dafür hast du nicht die Berechtigung",MSG_TYPE_ERROR);
            }
            $uid = Player::PIDtoUID(Input::get('owner'));
            if (Input::get('adv') == 'true') {
                if (!$user->hasPermision("VehicleResetAdv")) {
                    redirect(DE100_DOMAIN,"Dafür hast du nicht die Berechtigung",MSG_TYPE_ERROR);
                }
                $vehicle->resetVehicle(Input::get('id'),true);
                Logger::addLog("vehEdit",$uid,"ChopShop-Reset ".Input::get('vehicle').", Kennzeichen: ".Input::get('plate'));
            } else {
                $vehicle->resetVehicle(Input::get('id'));
                Logger::addLog("vehEdit",$uid,"Reset ".Input::get('vehicle').", Kennzeichen: ".Input::get('plate'));
            }
            add_message("Das Fahrzeug wurde zurücksetzt", MSG_TYPE_SUCCESS);
            break;
    }
    redirect(DIR_TO_SITES."vehicles");
}

$DE100_GLOBALS['content'] = "vehicles";
$DE100_GLOBALS['title'] = "Fahrzeuge - " .DE100_SITE_NAME;
$DE100_GLOBALS['permission'] = "VehicleView";
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>