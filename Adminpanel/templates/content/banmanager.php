<?php 
$bans = $user->getBannedPlayers();
?>

<div class="content-header">
    <h1>Ban Manager</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Ban Manager</li>
    </ol>
</div>

<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo ($user->hasPermision("BanUnbanAll"))? "Alle Bans": "Deine Bans"; ?></h3>
            </div>
            <div class="box-body table-responsive">
                <table id="BannedPlayers" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>SpielerID</th>
                            <th>Ban-Datum</th>
                            <th>Bis</th>
                            <?php if ($user->hasPermision("BanUnbanAll")){echo "<th>Von</th>";} ?>
                            <th>Grund</th>
                            <th><i class="fa fa-wrench pull-right"></i><?php if($user->hasPermision("BanTmp") || $user->hasPermision("BanPerm")):?><i class="fa fa-eraser pull-right"></i><?php endif;?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($bans as $data) {
                                echo "<tr>";
                                echo "<td>". $data['name'] ."</td>";
                                echo "<td>". $data['playerid'] ."</td>";
                                echo "<td>". ($data['insert_time']? date("d.m.Y H:i:s", strtotime($data['insert_time'])): "Keine Information") ."</td>";
                                echo "<td>". toDate($data['datum']) ."</td>";
                                if ($user->hasPermision("BanUnbanAll")) {
                                    echo "<td>". $data['von'] ."</td>";
                                }
                                echo "<td><a href='javascript:void(0)' reason='" . $data['grund']  . "' class='reason-btn'><i class='fa fa-eye' title='Grund'></i></a></td>";
                                echo "<td>";
                                if ($user->hasPermision("BanTmp") || $user->hasPermision("BanPerm")) {
                                    echo "<a href='javascript:void(0)' reason='" . $data['grund']  . "' banid='" . $data['id']  . "' class='edit-ban'><i class='fa fa-wrench pull-right' title='Bearbeiten'></i>";
                                }
                                echo "<a href='javascript:void(0)' banid='" . $data['id']  . "' name='" . $data['name']  . "' playerid='" . $data['playerid']  . "' class='unban'><i class='fa fa-eraser pull-right' title='Entbannen'></i>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>