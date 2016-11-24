<?php

?>

<div class="content-header">
    <h1>Fahrzeug</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo DIR_TO_SITES ;?>vehicles.php"> Fahrzeuge</a></li>
        <li class="active">
            <?php echo $vehicleData["name"] . "'s " . $vehicle->getVehName($vehicleData["classname"])?>
        </li>
    </ol>
</div>