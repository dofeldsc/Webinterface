<?php

?>

<div class="content-header">
    <h1>Spieler</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Spieler</li>
    </ol>
</div>
<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Spieler</h3>
            </div>
            <div class="box-body table-responsive">
                <table id="PlayerList" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Spieler ID</th>
                            <th>Bargeld</th>
                            <th>Kontostand</th>
                            <th>Admin</th>
                            <th>Polizist</th>
                            <th>Sanitäter</th>
                            <th>ADAC</th>
                            <th>Aliases</th>
                            <?php if($user->hasPermision("PlayersEdit")): ?>
                            <th><i class="fa fa-pencil pull-right"></i></th>
                            <?php endif;?>
                        </tr>
                    </thead>

                </table>
            </div>
            </div>
        </div>
    </div>
</div>