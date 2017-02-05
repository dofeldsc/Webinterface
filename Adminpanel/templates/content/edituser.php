<?php

?>

<div class="content-header">
    <h1><?php echo $target->username(); ?> bearbeiten</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo DIR_TO_SITES ;?>viewusers">Benutzer</a></li>
        <li class="active"><?php echo $target->username()?> bearbeiten</li>
    </ol>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Allgemeine Informationen
                    </h3>
                </div>
                <div class="box-body">
                    <img class="img-responsive img-circle center-block" src="<?php echo $target->getAvatar(); ?>" style="max-width:300px;max-height:300px;">
                    <br>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Benutzername</b> <p class="pull-right"><?php echo $target->username()?></p>
                        </li>
                        <li class="list-group-item">
                            <b>Aktueller Steamname</b> <p class="pull-right"><?php echo $target->username(true)?></p>
                        </li>
                        <?php if( $target->data()['steam_realname'] != "Unbekannt"): ?>
                        <li class="list-group-item">
                            <b>Name</b> <p class="pull-right"><?php echo $target->username()?></p>
                        </li>
                        <?php endif; ?>
                        <li class="list-group-item">
                            <b>Spieler-ID</b> <p class="pull-right"><?php echo $target->data()['player_id']?></p>
                        </li>
                        <li class="list-group-item">
                            <b>Rang</b><p class="pull-right text-<?php echo $target->rankcolor();?>"><?php echo $target->rankname()?></p>
                        </li>
                    </ul>
                    <?php if ($target->steamID()): ?>
                        <a href="<?php echo ($target->steamID())? DIR_TO_SITES."editplayer?id=".Player::PIDtoUID($target->steamID()) :"#";?>" class="btn btn-primary btn-block"><b>Charakter</b></a>
                    <?php endif; ?>
                    <?php if ($user->hasPermision("UserDel")): ?>
                    <a data-toggle="modal" class="confirm-del-btn btn btn-danger btn-block btn-flat col-xs-12"><b>Löschen</b></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Rechte
                    </h3>
                </div>
                <div class="box-body">
                    <?php 
                    $cnt = 0;
                    $count = count($PERMISSION_GROUPS);
                    $counter = 0;
                    foreach ($PERMISSION_GROUPS as $grp) :
                    if ($cnt == 0) {
                        echo "<div class='row'>";
                    }
                    $cnt ++;
                    $counter ++;
                    ?>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <h4><?php echo $grp[0];?></h4>
                        <div class="list-group">
                            <?php foreach ($grp[1] as $perm) {
                                $bg = ($target->hasPermision($perm))? "bg-green": "bg-red";
                                $icon = ($target->hasPermision($perm))? "check": "times";
                                $disabled = ($user->hasPermision($perm) || $user->hasPermision("UserRoot"))? "": "disabled";
                                echo "<a id='".$perm."' class='permissions list-group-item ".$bg." ".$disabled."'>".getPermissionName($perm)."<i class='fa fa-".$icon." pull-right' aria-hidden='true'></i></a>";
                            } ?>
                        </div>
                    </div>
                    <?php
                    if ($cnt >= 3 || $counter == $count) {
                        echo "</div>";
                        $cnt = 0;
                    }
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>