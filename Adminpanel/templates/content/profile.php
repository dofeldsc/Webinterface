<?php
if (!$user->isLoggedIn()) {
    redirect(DE100_DOMAIN);
}
$player = new Player(Player::PIDtoUID($user->steamID()));
$playerInfo = $player->data();
$uniform = toPhpArray($playerInfo['civ_gear']);
if (count($uniform) == 0) {
    $uniform = 'error';
} elseif (count($uniform[0][3]) == 0) {
    $uniform = 'error';
} else {
    $uniform = $uniform[0][3][0];
}
$bto = "Keinen";
if (strtotime($playerInfo['backpack']) > 0) {
    $backpack = "Ja";
    $bto = "Bis ".date("d.m.Y H:i",strtotime($playerInfo['backpack']))." Uhr";
}
?>

<div class="content-header">
    <h1>Profil</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Profil</li>
    </ol>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-8 col-xs-12">
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
                            <b>Spieler seit</b> <p class="pull-right"> <?php echo ($playerInfo['first_login'] == "To Old")? "Keine Information" : date("d.m.Y H:i", strtotime($playerInfo['first_login'])); ?></p>
                        </li>
                        <li class="list-group-item">
                            <b>Spieler-ID</b> <p class="pull-right"><?php echo $playerInfo['playerid']; ?></p>
                        </li>
                        <li class="list-group-item">
                            <b>Spieler-GUID</b> <p class="pull-right"> <?php echo !$playerInfo['guid']? "Keine Information":$playerInfo['guid']; ?></p>
                        </li>
                        <li class="list-group-item">
                            <b>Banstatus</b> <p class="pull-right"><?php echo (!$player->isBaned($playerInfo['playerid']))? "Nicht gebannt" : "Gebannt";?></p>
                        </li>
                        <li class="list-group-item">
                            <b>Banzähler</b><?php echo ($player->banCounter($playerInfo['playerid']))? "<p class='pull-right'>".$player->banCounter($playerInfo['playerid'])." Ban/s</a>" : "<p class='pull-right'>Keinen Ban</p>";?>
                        </li>
                        <li class="list-group-item">
                            <b>Gang</b> <p class="pull-right"><?php echo !$playerInfo['gang_name']? "Gehört keiner Gang an": $playerInfo['gang_name']; ?></p>
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
                    <?php if ($user->hasPermision("PlayersEdit")): ?>
                        <a href="<?php echo DIR_TO_SITES."editplayer?id=".Player::PIDtoUID($user->steamID());?>" class="btn btn-maroon btn-block btn-flat col-xs-12"><b>Charakter</b></a>
                    <?php endif; ?>
                    <?php if ($user->hasPermision("UserEdit")): ?>
                        <a href="<?php echo DIR_TO_SITES."edituser?id=".$user->data()['id'];?>" class="btn btn-primary btn-block btn-flat col-xs-12"><b>Benutzer</b></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="row">
                <div class="col-xs-12">
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
                <div class="col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow">
                        <i class="fa fa-wrench"></i>
                    </span>
                        <div class="info-box-content">
                            <span class="info-box-text">THR</span>
                            <span class="info-box-number"><?php echo $playerInfo['thrlevel'];?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red">
                        <i class="fa fa-car"></i>
                    </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Fahrzeuge</span>
                            <span class="info-box-number"><?php echo $player->getVehiclesCount();?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-purple">
                        <i class="fa fa-home"></i>
                    </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Häuser</span>
                            <span class="info-box-number"><?php echo $player->getHousesCount();?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-teal">
                        <i class="fa fa-shopping-basket"></i>
                    </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Rucksack</span>
                            <span class="info-box-number"><?php echo $bto;?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>