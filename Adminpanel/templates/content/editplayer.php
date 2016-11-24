<?php
$vehicles = $player->getVehicles();
?>
<div class="content-header">
    <h1>Spieler</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo DIR_TO_SITES ;?>players.php"> Spieler</a></li>
        <li class="active">
            <?php echo $playerInfo['name'];?>
        </li>
    </ol>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?php echo $playerInfo['name'];?>
                    </h3>
                </div>
                <div class="box-body box-profile">
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Decknamen</b> <a data-toggle="modal" href="#aliases" class="pull-right">Decknamen</a>
						</li>
						<li class="list-group-item">
							<b>Spieler seit</b> <p class="pull-right"> <?php echo ($playerInfo['first_login'] == "To Old")? "Keine Information" : date("d.m.Y H:i", strtotime($playerInfo['first_login'])); ?></p>
						</li>
                        <li class="list-group-item">
                            <b>Zuletzt gesehen</b> <p class="pull-right"> <?php echo ($playerInfo['first_login'] == "To Old")? "Keine Information" : date("d.m.Y H:i", strtotime($playerInfo['lastLogged'])); ?></p>
                        </li>
						<li class="list-group-item">
							<b>Spieler-ID</b> <p class="pull-right"><?php echo $playerInfo['playerid']; ?></p>
						</li>
						<li class="list-group-item">
							<b>Spieler-GUID</b> <p class="pull-right"> <?php echo !$playerInfo['guid']? "Keine Information":$playerInfo['guid']; ?></p>
						</li>
						<li class="list-group-item">
							<b>Banstatus</b> <p class="pull-right"><?php echo (!$player->isBaned($playerInfo['playerid']))? "Nicht gebannt" : "<a href='" . DIR_TO_SITES . "banmanager.php/?search=" . $playerInfo['playerid'] ."'>Gebannt</a>";?></p>
						</li>
						<li class="list-group-item">
							<b>Gang</b> <p class="pull-right"><?php echo !$playerInfo['gang_name']? "Gehört keiner Gang an":"<a href='editGangShit?id=" .  $playerInfo['gang_id'] . "'>" . $playerInfo['gang_name'] . "</a>"; ?></p>
						</li>
						<li class="list-group-item col-xs-6">
							<i class="fa fa-money fa-lg"></i>
							$ <?php echo number_format($playerInfo['cash'],0, ",", "."); ?>
						</li>
						<li class="list-group-item col-xs-6">
							<div class="pull-right">
								<i class="glyphicon glyphicon-piggy-bank fa-lg"></i>
		                    	$ <?php echo number_format($playerInfo['bankacc'],0, ",", "."); ?>
							</div>
                    	</li>
					</ul>
					<p class="col-xs-12"><p>
					<a href="http://webinterface.playerindex.de/default.aspx?id=<?php echo $playerInfo['playerid']; ?>" target="_blank" class="btn btn-primary btn-block btn-flat col-xs-12"><b>Playerindex Check</b></a>
					<?php if ($user->hasPermision("BanTmp") OR $user->hasPermision("BanPerm")): ?>
					<a href="#ban" data-toggle="modal" class="btn btn-warning btn-block btn-flat col-xs-12"><b>Bannen</b></a>
                    <a href="#" data-toggle="modal" class="btn btn-danger btn-block btn-flat col-xs-12"><b>Löschen</b></a>
					<?php endif;?>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-xs-12">
            <div class="row">

                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-blue">
                        <i class="fa fa-taxi"></i>
                    </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Polizei</span>
                            <span class="info-box-number"><?php echo $playerInfo['coplevel'];?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red">
                        <i class="fa fa-ambulance"></i>
                    </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Sanitäter</span>
                            <span class="info-box-number"><?php echo $playerInfo['mediclevel'];?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow">
                        <i class="fa fa-wrench"></i>
                    </span>
                        <div class="info-box-content">
                            <span class="info-box-text">ADAC</span>
                            <span class="info-box-number"><?php echo $playerInfo['life_job'];?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-purple">
                        <i class="fa fa-bolt"></i>
                    </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Admin</span>
                            <span class="info-box-number"><?php echo $playerInfo['adminlevel'];?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-teal">
                        <i class="fa fa-usd"></i>
                    </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Rucksack</span>
                            <span class="info-box-number text-uppercase"><?php echo yesNo($playerInfo['backpack']);?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-black">
                        <i class="fa fa-steam"></i>
                    </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Steam</span>
                            <span class="info-box-number"><a href="http://steamcommunity.com/profiles/<?php echo $playerInfo['playerid']?>" target="_blank">PROFIL</a></span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="nav-tabs-custom tab-warning">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="dropdown active">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Lizenzen <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li role="presentation" class="active"><a href="#licCiv" aria-controls="profile" role="tab" data-toggle="tab">Zivilist</a></li>
                            <li role="presentation"><a href="#licCop" aria-controls="vehicles" role="tab" data-toggle="tab">Polizei</a></li>
                            <li role="presentation"><a href="#licMed" aria-controls="vehicles" role="tab" data-toggle="tab">Sanitäter</a></li>
                        </ul>
                    </li>

                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Inventar <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li role="presentation"><a href="#invCiv" aria-controls="profile" role="tab" data-toggle="tab">Zivilist</a></li>
                            <li role="presentation"><a href="#invCop" aria-controls="vehicles" role="tab" data-toggle="tab">Polizei</a></li>
                            <li role="presentation"><a href="#invMed" aria-controls="vehicles" role="tab" data-toggle="tab">Sanitäter</a></li>
                            <li role="presentation"><a href="#invNoBody" aria-controls="vehicles" role="tab" data-toggle="tab">NoBody</a></li>
                        </ul>
                    </li>
                    <?php if($user->hasPermision("VehicleView")):?>
                        <li role="presentation"><a href="#vehicles" aria-controls="vehicles" role="tab" data-toggle="tab">Fahrzeuge</a></li>
                    <?php endif;?>
                    <li role="presentation"><a href="#houses" aria-controls="houses" role="tab" data-toggle="tab">Häuser</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="licCiv">
                        <div class="box-header with-border">
                            <h3>Zivilisten-Lizenzen</h3>
                        </div>
                        <div class="box-body">
                            <?php
                                foreach (toPhpArray($playerInfo['civ_licenses']) as $lic) {
                                    if (!in_array($lic[0],$ARMA_IGNORED_LICENSES)) {
                                        if ($lic[1] == 1) {
                                            echo "<button type='button' id=" . $lic[0] . " side='civ' class='license btn btn-sm btn-success' style='margin-bottom: 5px;'>" . $player->getLicName($lic[0]) . "</button> ";
                                        } else {
                                            echo "<button type='button' id=" . $lic[0] . " side='civ' class='license btn btn-sm btn-danger' style='margin-bottom: 5px;'>" . $player->getLicName($lic[0]) . "</button> ";
                                        }
                                    }
                                    
                                }
                            ?>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="licCop">
                        <div class="box-header with-border">
                            <h3>Polizei-Lizenzen</h3>
                        </div>
                        <div class="box-body">
                            <?php
                                foreach (toPhpArray($playerInfo['cop_licenses']) as $lic) {
                                    if (!in_array($lic[0],$ARMA_IGNORED_LICENSES)) {
                                        if ($lic[1] == 1) {
                                            echo "<button type='button' id=" . $lic[0] . " side='cop'  class='license btn btn-sm btn-success' style='margin-bottom: 5px;'>" . $player->getLicName($lic[0]) . "</button> ";
                                        } else {
                                            echo "<button type='button' id=" . $lic[0] . " side='cop' class='license btn btn-sm btn-danger' style='margin-bottom: 5px;'>" . $player->getLicName($lic[0]) . "</button> ";
                                        }
                                    }
                                    
                                }
                            ?>                            
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="licMed">
                        <div class="box-header with-border">
                            <h3>Sanitäter-Lizenzen</h3>
                        </div>
                        <div class="box-body">
                            <?php
                                foreach (toPhpArray($playerInfo['med_licenses']) as $lic) {
                                    if (!in_array($lic[0],$ARMA_IGNORED_LICENSES)) {
                                        if ($lic[1] == 1) {
                                            echo "<button type='button' id=" . $lic[0] . " side='med'  class='license btn btn-sm btn-success' style='margin-bottom: 5px;'>" . $player->getLicName($lic[0]) . "</button> ";
                                        } else {
                                            echo "<button type='button' id=" . $lic[0] . " side='med'  class='license btn btn-sm btn-danger' style='margin-bottom: 5px;'>" . $player->getLicName($lic[0]) . "</button> ";
                                        }
                                    }
                                    
                                }
                            ?>                            
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="invCiv">
                        <div class="box-header with-border">
                            <h3>Zivilisten-Inventar</h3>
                        </div>
                        <div class="box-body">
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="invCop">
                        <div class="box-header with-border">
                            <h3>Polizei-Inventar</h3>
                        </div>
                        <div class="box-body">
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="invMed">
                        <div class="box-header with-border">
                            <h3>Sanitäter-Inventar</h3>
                        </div>
                        <div class="box-body">
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="invNoBody">
                        <div class="box-header with-border">
                            <h3>Nobody-Inventar</h3>
                        </div>
                        <div class="box-body">
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="vehicles">
                        <div class="box-header with-border">
                            <h3>Fahrzeuge</h3>
                        </div>
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Fahrzeug</th>
                                        <th>Art</th>
                                        <th>Seite</th>
                                        <th><i class="fa fa-pencil pull-right"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (count($vehicles) >= 10) {
                                            $counter = 10;
                                        } else {
                                            $counter = count($vehicles);
                                        }
                                        
                                        for ($x = 0; $x < $counter ; $x++) {
                                            echo "<tr>";
                                            echo "<th>". $vehicle->getVehName($vehicles[$x]['classname']) ."</th>";
                                            echo "<th>" . $vehicle->convertType($vehicles[$x]['type']) . "</th>";
                                            echo "<th>" . $vehicle->convertSide($vehicles[$x]['side']) . "</th>";
                                            echo "<th><a href='". DIR_TO_SITES ."editvehicle.php/?id=". $vehicles[$x]['id'] ."'><i class='fa fa-pencil pull-right' title='Bearbeiten'></i></th>";
                                            echo "</tr>";
                                        } 
                                    ?>
                                </tbody>
                            </table>
                            <h4 class="pull-right">
                                <a href="<?php echo DIR_TO_SITES ."vehicles.php?search=".$playerInfo['playerid'] ?>">Mehr <i class="fa fa-arrow-circle-right"></i></a>
                            </h4>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="houses">
                        <div class="box-header with-border">
                            <h3>Häuser</h3>
                        </div>
                        <div class="box-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>