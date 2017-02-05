<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
$vehicle = new Vehicle(Input::get('id'));
$vehicleData = $vehicle->data();
if (!$vehicleData) {
    redirect(DE100_DOMAIN,"Der Fahrzeug konnte nicht gefunden werden",MSG_TYPE_ERROR);
}


$DE100_GLOBALS['content'] = "editvehicle";
$DE100_GLOBALS['title'] = $vehicleData["name"] . "'s " . $vehicle->getVehName($vehicleData["classname"]) . " bearbeiten - " .DE100_SITE_NAME;
$DE100_GLOBALS['permission'] = "VehicleEdit";
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
