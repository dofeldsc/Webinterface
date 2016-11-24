<?php

?>

<div class="content-header">
    <h1><?php echo $target->username(); ?> bearbeiten</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo DIR_TO_SITES ;?>viewusers.php">Benutzer</a></li>
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
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Benutzername</b> <p class="pull-right"><?php echo $target->username()?></p>
                        </li>
                        <li class="list-group-item">
                            <b>Rang</b><p class="pull-right text-<?php echo $target->rankcolor();?>"><?php echo $target->rankname()?></p>
                        </li>
                    </ul>
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
                    <div class="row">
                        <?php foreach ($PERMISSION_GROUPS as $grp) :?>
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
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>