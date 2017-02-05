<?php
    $vehicles = $player->getVehicles();
    $uniform = toPhpArray($playerInfo['civ_gear']);

    if (count($uniform) == 0) {
        $uniform = 'error';
    } elseif (count($uniform[0][3]) == 0) {
        $uniform = 'error';
    } else {
        $uniform = $uniform[0][3][0];
    }

    $backpack = "Nein";
    $bto = "";
    if (strtotime($playerInfo['backpack']) > 0) {
        $backpack = "Ja";
        $bto = date("d.m.Y H:i:s",strtotime($playerInfo['backpack']));
    }
?>
<div class="content-header">
    <h1>Spieler</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo DIR_TO_SITES ;?>players"> Spieler</a></li>
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
                    <img class="editplayer" src="<?php echo $player->getSkin($uniform) ?>">
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Decknamen</b> <a data-toggle="modal" href="#aliases" class="pull-right">Decknamen</a>
						</li>
						<li class="list-group-item">
							<b>Spieler seit</b> <p class="pull-right"> <?php echo ($playerInfo['first_login'] == "To Old")? "Keine Information" : date("d.m.Y H:i", strtotime($playerInfo['first_login'])); ?></p>
						</li>
                        <li class="list-group-item">
                            <b>Zuletzt gesehen</b> <p class="pull-right"> <?php echo ($playerInfo['lastLogged'] == "To Old")? "Keine Information" : date("d.m.Y H:i", strtotime($playerInfo['lastLogged'])); ?></p>
                        </li>
						<li class="list-group-item">
							<b>Spieler-ID</b> <p class="pull-right"><?php echo $playerInfo['playerid']; ?></p>
						</li>
						<li class="list-group-item">
							<b>Spieler-GUID</b> <p class="pull-right"> <?php echo !$playerInfo['guid']? "Keine Information":$playerInfo['guid']; ?></p>
						</li>
						<li class="list-group-item">
							<b>Banstatus</b> <p class="pull-right"><?php echo (!$player->isBaned($playerInfo['playerid']))? "Nicht gebannt" : "<a href='" . DIR_TO_SITES . "banmanager?search=" . $playerInfo['playerid'] ."'>Gebannt</a>";?></p>
						</li>
                        <li class="list-group-item">
                            <b>Banzähler</b><?php echo ($player->banCounter($playerInfo['playerid']))? "<a data-toggle='modal' href='#bans' class='pull-right'>".$player->banCounter($playerInfo['playerid'])." Ban/s</a>" : "<p class='pull-right'>Keinen Ban</p>";?>
                        </li>
						<li class="list-group-item">
							<b>Gang</b> <p class="pull-right"><?php echo !$playerInfo['gang_name']? "Gehört keiner Gang an": ($user->hasPermision("GangEdit")? "<a href='editgang?id=" .  $playerInfo['gang_id'] . "'>" . $playerInfo['gang_name'] . "</a>" : $playerInfo['gang_name']); ?></p>
						</li>
                        <li class="list-group-item col-xs-6">
                            <i class="fa fa-money fa-lg"></i>
                            $ <?php echo number_format($playerInfo['cash'],0, ",", "."); ?>
                        </li>
                        <li class="list-group-item col-xs-6">
                            <div class="pull-right">
                                <i class="fa fa-balance-scale fa-lg"></i>
                                $ <?php echo number_format($playerInfo['bankacc'],0, ",", "."); ?>
                            </div>
                        </li>
					</ul>
					<p class="col-xs-12"></p>
					<a href="http://webinterface.playerindex.de/default.aspx?id=<?php echo $playerInfo['playerid']; ?>" target="_blank" class="btn btn-primary btn-block btn-flat col-xs-12"><b>Playerindex Check</b></a>
					<?php if ($user->hasPermision("BanTmp") OR $user->hasPermision("BanPerm")): ?>
					<a href="#ban" class="btn btn-warning btn-block btn-flat col-xs-12" <?php echo ($player->isBaned($playerInfo['playerid']))? "disabled" : "data-toggle='modal'";?>><b>Bannen</b></a>
                    <?php endif;?>
                    <?php if ($user->hasPermision("PCash")): ?>
                    <a href="#money" data-toggle="modal" class="btn btn-maroon btn-block btn-flat col-xs-12"><b>Geld erstatten</b></a>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-xs-12">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-blue" <?php if ($user->hasPermision("CopRank")) {echo 'id="Cop_trigger"';} ?> state=<?php echo $playerInfo['coplevel'];?>>
                        <i class="fa fa-taxi"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Polizei</span>
                            <span class="info-box-number" id="cop_rang"><?php echo $playerInfo['coplevel'];?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow" <?php if ($user->hasPermision("ThrRank")) {echo 'id="THR_trigger"';} ?> state=<?php echo $playerInfo['thrlevel'];?>>
                        <i class="fa fa-wrench"></i>
                    </span>
                        <div class="info-box-content">
                            <span class="info-box-text">THR</span>
                            <span class="info-box-number" id="thr_rang"><?php echo $playerInfo['thrlevel'];?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-purple" <?php if ($user->hasPermision("AdRank")) {echo 'id="Admin_trigger"';} ?> state=<?php echo $playerInfo['adminlevel'];?>>
                        <i class="fa fa-bolt"></i>
                    </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Admin</span>
                            <span class="info-box-number" id="admin_rang"><?php echo $playerInfo['adminlevel'];?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-teal" <?php if ($user->hasPermision("InvBack")) {echo 'id="Invis_Backpack"';} ?> state=<?php echo strtotime($playerInfo['backpack']);?>>
                            <i class="fa fa-usd"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Rucksack</span>
                            <span class="info-box-number text-uppercase" id="invis_range" title='<?php echo $bto;?>'><?php echo $backpack;?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red" <?php if ($user->hasPermision("NoBodyRank")) {echo 'id="NB_trigger"';} ?> state=<?php echo $playerInfo['nobody_level'];?>>
                        <i class="fa fa-bomb"></i>
                    </span>
                        <div class="info-box-content">
                            <span class="info-box-text">NoBody</span>
                            <span class="info-box-number" id="NB_rang"><?php echo yesNo($playerInfo['nobody_level']);?></span>
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
            <div class="row">
                <div class="col-xs-12">
                    <div class="nav-tabs-custom tab-warning">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="dropdown active">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Lizenzen <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li role="presentation" class="active"><a href="#licCiv" aria-controls="profile" role="tab" data-toggle="tab">Zivilist</a></li>
                                    <li role="presentation"><a href="#licCop" aria-controls="vehicles" role="tab" data-toggle="tab">Polizei</a></li>
                                    <li role="presentation"><a href="#licThr" aria-controls="vehicles" role="tab" data-toggle="tab">THR</a></li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Inventar <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li role="presentation"><a href="#invCiv" aria-controls="profile" role="tab" data-toggle="tab">Zivilist</a></li>
                                    <li role="presentation"><a href="#invCop" aria-controls="vehicles" role="tab" data-toggle="tab">Polizei</a></li>
                                    <li role="presentation"><a href="#invThr" aria-controls="vehicles" role="tab" data-toggle="tab">THR</a></li>
                                    <li role="presentation"><a href="#invNoBody" aria-controls="vehicles" role="tab" data-toggle="tab">NoBody</a></li>
                                </ul>
                            </li>
                            <?php if($user->hasPermision("VehicleView")):?>
                                <li role="presentation"><a href="#vehicles" aria-controls="vehicles" role="tab" data-toggle="tab">Fahrzeuge</a></li>
                            <?php endif;?>
                            <li role="presentation"><a href="#houses" aria-controls="houses" role="tab" data-toggle="tab">Häuser</a></li>
                            <li role="presentation"><a href="#transactions" aria-controls="transactions" role="tab" data-toggle="tab" id="trigger_trans">Transaktionen</a></li>
                            <li role="presentation"><a href="#slogs" aria-controls="slogs" role="tab" data-toggle="tab" id="trigger_slogs">Spieler-Logs</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="licCiv">
                                <div class="box-header with-border">
                                    <h3>Zivilisten-Lizenzen</h3>
                                </div>
                                <div class="box-body">          
                                    <?php
                                        $array = toPhpArray($playerInfo['civ_licenses']);
                                        $arrCnt = round(count($array));
                                        $counter = 14;
                                        foreach ($array as $lic) {
                                            if (!in_array($lic[0],$ARMA_IGNORED_LICENSES)) {
                                                if ($counter >= 14) {
                                                    echo '<ul class="list-group col-lg-'.(($arrCnt > 14)? '6': '12').' col-xs-12">';
                                                    $counter = 0;
                                                }
                                                echo "<li class='list-group-item'>";
                                                if ($lic[1] == 1) {
                                                    echo $player->getLicName($lic[0]).'<span class="pull-right"><input class="license" data-on-color="success" data-off-color="danger" data-on-text="Im Besitz" data-off-text="Nope" data-size="mini" type="checkbox" checked side="civ" id='.$lic[0].'></span>';
                                                } else {
                                                    echo $player->getLicName($lic[0]).'<span class="pull-right"><input class="license" data-on-color="success" data-off-color="danger" data-on-text="Im Besitz" data-off-text="Nope" data-size="mini" type="checkbox" side="civ" id='.$lic[0].'></span>';
                                                }
                                                echo "</li>";
                                                $counter = $counter + 1;
                                                if ($counter >= 14) {
                                                    echo '</ul>';
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
                                        $array = toPhpArray($playerInfo['cop_licenses']);
                                        $arrCnt = round(count($array));
                                        $counter = 14;
                                        foreach ($array as $lic) {
                                            if (!in_array($lic[0],$ARMA_IGNORED_LICENSES)) {
                                                if ($counter >= 14) {
                                                    echo '<ul class="list-group col-lg-'.(($arrCnt > 14)? '6': '12').' col-xs-12">';
                                                    $counter = 0;
                                                }
                                                echo "<li class='list-group-item'>";
                                                if ($lic[1] == 1) {
                                                    echo $player->getLicName($lic[0]).'<span class="pull-right"><input class="license" data-on-color="success" data-off-color="danger" data-on-text="Im Besitz" data-off-text="Nope" data-size="mini" type="checkbox" checked side="cop" id='.$lic[0].'></span>';
                                                } else {
                                                    echo $player->getLicName($lic[0]).'<span class="pull-right"><input class="license" data-on-color="success" data-off-color="danger" data-on-text="Im Besitz" data-off-text="Nope" data-size="mini" type="checkbox" side="cop" id='.$lic[0].'></span>';
                                                }
                                                echo "</li>";
                                                $counter = $counter + 1;
                                                if ($counter >= 14) {
                                                    echo '</ul>';
                                                }
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            
                            <div role="tabpanel" class="tab-pane" id="licThr">
                                <div class="box-header with-border">
                                    <h3>THR-Lizenzen</h3>
                                </div>
                                <div class="box-body">
                                    <?php
                                        $array = toPhpArray($playerInfo['thr_licenses']);
                                        $arrCnt = round(count($array));
                                        $counter = 14;
                                        foreach ($array as $lic) {
                                            if (!in_array($lic[0],$ARMA_IGNORED_LICENSES)) {
                                                if ($counter >= 14) {
                                                    echo '<ul class="list-group col-lg-'.(($arrCnt > 14)? '6': '12').' col-xs-12">';
                                                    $counter = 0;
                                                }
                                                echo "<li class='list-group-item'>";
                                                if ($lic[1] == 1) {
                                                    echo $player->getLicName($lic[0]).'<span class="pull-right"><input class="license" data-on-color="success" data-off-color="danger" data-on-text="Im Besitz" data-off-text="Nope" data-size="mini" type="checkbox" checked side="thr" id='.$lic[0].'></span>';
                                                } else {
                                                    echo $player->getLicName($lic[0]).'<span class="pull-right"><input class="license" data-on-color="success" data-off-color="danger" data-on-text="Im Besitz" data-off-text="Nope" data-size="mini" type="checkbox" side="thr" id='.$lic[0].'></span>';
                                                }
                                                echo "</li>";
                                                $counter = $counter + 1;
                                                if ($counter >= 14) {
                                                    echo '</ul>';
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
                                <?php
                                    $gear = toPhpArray($playerInfo['civ_gear'])[0];
                                    $primary = $gear[0];//array
                                    $secoundary = $gear[1];//array
                                    $handgun = $gear[2];//array
                                    $uniform = $gear[3];//array
                                    $vest = $gear[4];//array
                                    $backback = $gear[5];//array
                                    $helmet = $gear[6];//String
                                    $facewear = $gear[7];//String
                                    $binocular = $gear[8];//array
                                    $assignedItems = $gear[9];//array

                                    echo $player->getItemName($facewear);
                                    echo $player->getItemName($uniform[0]);
                                ?>
                                </div>
                            </div>
                            
                            <div role="tabpanel" class="tab-pane" id="invCop">
                                <div class="box-header with-border">
                                    <h3>Polizei-Inventar</h3>
                                </div>
                                <div class="box-body">
                                </div>
                            </div>
                            
                            <div role="tabpanel" class="tab-pane" id="invThr">
                                <div class="box-header with-border">
                                    <h3>THR-Inventar</h3>
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
                                                <th>Kennzeichen</th>
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
                                                    echo "<th>". $vehicles[$x]['plate'] ."</th>";
                                                    echo "<th>" . $vehicle->convertType($vehicles[$x]['type']) . "</th>";
                                                    echo "<th>" . $vehicle->convertSide($vehicles[$x]['side']) . "</th>";
                                                    echo "<th><a href='". DIR_TO_SITES ."editvehicle?id=". $vehicles[$x]['id'] ."'><i class='fa fa-pencil pull-right' title='Bearbeiten'></i></th>";
                                                    echo "</tr>";
                                                } 
                                            ?>
                                        </tbody>
                                    </table>
                                    <h4 class="pull-right">
                                        <a href="<?php echo DIR_TO_SITES ."vehicles?search=".$playerInfo['playerid'] ?>">Mehr <i class="fa fa-arrow-circle-right"></i></a>
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
                            <div role="tabpanel" class="tab-pane" id="transactions">
                                <div class="box-header with-border">
                                    <h3>Transaktionen</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="form-group has-feedback">
                                            <label class="col-md-12 control-label">Arten-Filtern:</label>
                                            <div class="col-md-12">
                                                <select class="form-control" id="TypeFilter">
                                                    <option selected value="">Alle</option>
                                                    <option value="0">(e.) Überweisungen</option>
                                                    <option value="2">Einzahlung</option>
                                                    <option value="1">Auszahlung</option>
                                                    <option value="3">Gang-Einzahlungen</option>
                                                    <option value="4">Gang-Auszahlungen</option>
                                                </select>
                                            </div>
                                            <span class="col-md-12 help-block">e. = empfangen</span>
                                        </div>
                                    </div>
                                    <br>
                                    <table class="table table-bordered table-hover table-striped table-responsive" id="Transactions">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Zeitpunkt</th>
                                                <th>Art</th>
                                                <th>Betrag</th>
                                                <th>Ziel</th>
                                                <th>Kommentar</th>
                                                <th>Misc</th>
                                                <th>Misc</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="slogs">
                                <div class="box-header with-border">
                                    <h3>Spieler-Logs</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="form-group has-feedback">
                                            <label class="col-md-12 control-label">Filter:</label>
                                            <div class="col-md-12">
                                                <select class="form-control" id="SlogFilter">
                                                    <option selected value="">Alle</option>
                                                    <?php
                                                        foreach ($player->getPlayerLogType() as $inf) {
                                                            echo '<option value="'.$inf["id"].'">'.$inf["text"].'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <table class="table table-bordered table-hover table-striped table-responsive" id="sLogTabel">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Zeitpunkt</th>
                                                <th>Type</th>
                                                <th>Type</th>
                                                <th>Aktion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach ($player->getPlayerLogs() as $val) {
                                                    echo "<tr>";
                                                    echo "<th>".$val["id"]."</th>";
                                                    echo "<th>".date("d.m.Y H:i",strtotime($val["date"]))."</th>";
                                                    echo "<th>".$val["type"]."</th>";
                                                    echo "<th>".$val["text"]."</th>";
                                                    echo "<th>".$val["msg"]."</th>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="box-header with-border">
                        <hr>
                            <h3><i class="fa fa-comments"></i> Kommentare</h3>
                        </div>
                        <div class="box-footer box-comments">
                        <?php if($player->getComments()) { ?>
                        <?php foreach($player->getComments() as $comment):?>
                            <div class="box-comment">
                                <img class="img-circle img-sm" src="<?php echo $user->getAvatar($comment['author_id']);?>" alt="User Image">
                                <div class="comment-text">
                                    <span class="username">
                                        <?php echo $comment['author_name'] ?>
                                        <span class="text-muted pull-right"><?php echo date("d.m.Y H:i:s", strtotime($comment['date'])); ?> 
                                            <?php if($comment['author_id'] == $user->data()['id']): ?>
                                                <span>&nbsp;|&nbsp;&nbsp;</span><a class="pull-right" href="<?php echo DIR_TO_SITES."editplayer?id=".$playerInfo['uid']."&remove_comment=".$comment['id'] ?>"><i class="fa fa-trash" title='Löschen'></i></a>
                                            <?php endif ?>
                                        </span>
                                    </span>
                                   <?php echo make_links_clickable($comment['text']) ?>
                                </div>
                            </div>
                        <?php endforeach;?>
                        <?php } else {?>
                            <div class="box-comment">
                                <div class="text-center">
                                    <h4>Keine Kommentare gefunden</h4>
                                </div>
                            </div>
                        <?php }; ?>
                        </div>
                        <div class="box-footer">
                          <form method="post">
                            <img class="img-responsive img-circle img-sm" src="<?php echo $user->getAvatar();?>" alt="Alt Text">
                            <div class="img-push">
                              <input type="text" class="form-control input-sm" name="add_comment" placeholder="Drücke Enter um eine Kommentar hinzuzufügen">
                            </div>
                          </form>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</div>