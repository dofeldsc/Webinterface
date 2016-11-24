<?php 
$useres = $user->getAllUsers();
?>

<div class="content-header">
    <h1>Benutzer</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Benutzer</li>
    </ol>
</div>

<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Benutzer</h3>
            </div>
            <div class="box-body table-responsive">
                <table id="BannedPlayers" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Benutzer</th>
                            <th>Gruppe</th>
                            <?php if ($user->hasPermision("UserEdit")): ?>
                                <th><i class="fa fa-wrench pull-right"></i></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($useres as $data) {
                                echo "<tr>";
                                echo "<td>". $data['username'] ."</td>";
                                echo "<td>". $data['title'] ."</td>";
                                if ($user->hasPermision("UserEdit")) {
                                    echo "<td>";
                                    echo "<a href='" . DIR_TO_SITES . "edituser.php/?id=" . $data['id'] . "'><i class='fa fa-wrench pull-right' title='Bearbeiten'></i>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>