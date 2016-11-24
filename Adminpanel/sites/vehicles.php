<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
$vehicle = new Vehicle();

if (Input::get('action')) {
    switch(Input::get('action')){
        case 'reset':
            //Permmision CHECK!! SINCE YOU CAN HACK THIS!
            if (!$user->hasPermision("VehicleReset")) {
                redirect(DE100_DOMAIN,"Was hast du den da Versucht ?",MSG_TYPE_ERROR);
            }
			$vehicle->resetVehicle(Input::get('id'));
            add_message("Das Fahrzeug wurde zurücksetzt", MSG_TYPE_SUCCESS);
            break;
    }
    redirect(DIR_TO_SITES."vehicles.php");
}

$DE100_GLOBALS['content'] = "vehicles";
$DE100_GLOBALS['title'] = "Fahrzeuge - " .DE100_SITE_NAME;
$DE100_GLOBALS['permission'] = "VehicleView";
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
