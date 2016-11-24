<?php 
?>

<div class="content-header">
    <h1>User hinzufügen</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">User hinzufügen</li>
    </ol>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Daten</h3>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" method="post">
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">Benutzername:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="AddUser" placeholder="Benutzername">
                            </div>
                        </div>
                        
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">Passwort:</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="AddPass" placeholder="Passwort">
                            </div>
                        </div>
                    
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">Gruppe:</label>
                            <div class="col-md-9">
                                <select class="form-control" name="AddRank" id="rank">
                                    <option selected disabled value="void">Gruppe</option>
                                    <?php
                                        foreach ($user->getAllRanks() as $rank) {
                                            echo "<option value='" . $rank['id'] . "'>" . $rank['title'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="AddPerm" id="Permissions" value="[]">
                        <button type="submit" class="btn btn-flat btn-success pull-right" name="create_submit">Erstellen</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Berechtigungen</h3>
                </div>
                <div class="box-body">
                    <?php foreach ($PERMISSION_GROUPS as $grp) :?>
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <h4><?php echo $grp[0];?></h4>
                            <div class="list-group">
                                <?php foreach ($grp[1] as $perm) :?>
                                      <a id="<?php echo $perm ?>" class="permissions list-group-item bg-red"><?php echo getPermissionName($perm) ?><i class="fa fa-times pull-right" aria-hidden="true"></i></a>
                                <?php endforeach;?>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>