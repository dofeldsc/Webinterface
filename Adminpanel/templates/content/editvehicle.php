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
<div class="content">
	<div class="row">
		<div class="col-md-4 col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">
						<?php
							echo $vehicleData["name"] . "'s " . $vehicle->getVehName($vehicleData["classname"])
						?>
					</h3>
				</div>
				<div class="box-body">
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Kennzeichen</b> <p class="pull-right"><?php echo $vehicleData["plate"] ?></p>
						</li>
						<li class="list-group-item">
							<b>Farbe</b> <p class="pull-right"><?php echo $vehicleData["color"] ?></p>
						</li>
						<li class="list-group-item">
							<b>Kaufdatum</b> <p class="pull-right"><?php echo ($vehicleData['zeitpunkt'])? date("d.m.Y H:i", strtotime($vehicleData['zeitpunkt'])): "Keine Informationen" ?></p>
						</li>
						<li class="list-group-item">
							<b>Besitzer</b> <a href="#" class="pull-right"><?php echo $vehicleData["name"] ?></a>
						</li>
						<li class="list-group-item">
							<b>Zustand</b> <p class="pull-right"><?php echo ($vehicleData["alive"])? '<span class="label label-success">Okay</span>': '<span class="label label-danger">Zerstört</span>'; ?></p>
						</li>
						<li class="list-group-item">
							<b>Garagen-Status</b> <p class="pull-right"><?php echo ($vehicleData["active"] == 0)? '<span class="label label-success">Geparkt</span>': '<span class="label label-danger">Ausgeparkt</span>' ?></p>
						</li>
						<li class="list-group-item">
							<b>ChopShop</b> <p class="pull-right"><?php echo ($vehicleData["chopShop"])? '<span class="label label-danger">Verkauft '.date("d.m.Y H:i", strtotime($vehicleData["chopShop"])).'</span>': '<span class="label label-success">Nein</span>'; ?></p>
						</li>
						<li class="list-group-item">
							<b>Tank</b>
							<?php 
								$f = $vehicleData['fuel'];
								if ($f >= .66) {
					                $c = "success";
					            } elseif ($f >= .33) {
					                $c = "warning";
					            } elseif ($f >= .0) {
					                $c = "danger";
					            }
								$f = $f * 100 . '%';
								echo '<div class="col-xs-8 progress progress-md pull-right"><div class="progress-bar progress-bar-'.$c.' progress-bar-striped" style="width: '.$f.'"></div></div>'
							?>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-xs-12">
			<div class="box box-success">
				<div class="box-header">
					
				</div>
				<div class="box-body"></div>
			</div>
		</div>
	</div>
</div>