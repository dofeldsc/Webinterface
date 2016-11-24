<?php
?>

<div class="content-header">
    <h1>Profil</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Profil</li>
    </ol>
</div>

<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?php echo $user->username(); ?>
                    </h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <img class="img-responsive img-circle center-block" src="<?php echo DIR_TO_IMG?>avatar.png" alt="User profile picture">
                            <br>
                            <a href="#" class="btn btn-primary btn-block"><b>Charakter</b></a>
                        </div>
                        <div class="col-xs-8">
                            <form class="form-horizontal" method="post">
                                <div class="form-group has-feedback">
                                    <label class="col-md-3 control-label">Benutzername:</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" disabled name="Username" placeholder="<?php echo $user->username(); ?>">
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="col-md-3 control-label">Spieler-ID:</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="SteamID" placeholder="Spieler-ID">
                                    </div>
                                </div>

                                <div class="form-group has-feedback">
                                    <label class="col-md-3 control-label">Altes Passwort:</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="oldpass" placeholder="Altes Passwort">
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="col-md-3 control-label">Neues Passwort:</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="password_new" placeholder="Neues Passwort">
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="col-md-3 control-label">Passwort bestätigen:</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="password_new_again" placeholder="Passwort bestätigen">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-flat btn-success pull-right" name="create_submit">Speichern</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>