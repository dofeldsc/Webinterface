<?php
?>

<div class="content-header">
    <h1>Fahrzeuge</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Fahrzeuge</li>
    </ol>
</div>
<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Fahrzeuge</h3>
            </div>
            <div class="box-body table-responsive">
                <table id="VehicleList" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Fahrzeug</th>
                            <th>Kennzeichen</th>
                            <th>Art</th>
                            <th>Seite</th>
                            <th>Kaufdatum</th>
                            <th>Besitzer</th>
                            <th>Besitzer-UID</th>
                            <th>Status</th>
                            <th>Garagen-Status</th>
                            <th>ChopShop-Status</th>
                            <th>Tank</th>
                            <?php if($user->hasPermision("VehicleEdit") || $user->hasPermision("VehicleReset") || $user->hasPermision("VehicleResetAdv")):?>
                            <th>
                                <?php if($user->hasPermision("VehicleEdit")): ?>
                                <i class="fa fa-pencil pull-right"></i>
                                <?php endif;?>
                                <?php if($user->hasPermision("VehicleReset") || $user->hasPermision("VehicleResetAdv")): ?>
                                <i class="fa fa-sign-in pull-right"></i>
                                <?php endif;?>
                            </th>
                            <?php endif;?>
                        </tr>
                    </thead>

                </table>
            </div>
            </div>
        </div>
    </div>
</div>