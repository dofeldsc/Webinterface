<?php 
$onlinePlayers = $rcon->getPlayersArray();
?>

<div class="content-header">
    <h1>Online Spieler</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Online Spieler</li>
    </ol>
</div>
<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Online Spieler (<?php echo count ($rcon->getPlayersArray()) ?>)</h3>
            </div>
            <div class="box-body table-responsive">
                <table id="OnlinePlayerList" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>IP-Adresse</th>
                            <th>Ping</th>
                            <th>GUID</th>
                            <?php if ($user->hasPermision("BanTmp") || $user->hasPermision("BanPerm") || $user->hasPermision("BanKick")): ?>
                            <th>
                                <?php if ($user->hasPermision("BanPerm")) :?>
                                <i class="fa fa-gavel pull-right"></i>
                                <?php endif; ?>
                                <?php if ($user->hasPermision("BanTmp")) :?>
                                <i class="fa fa-clock-o pull-right"></i>
                                <?php endif; ?>
                                <?php if ($user->hasPermision("BanKick")) :?>
                                <i class="fa fa-ban pull-right"></i>
                                <?php endif; ?>
                            </th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($onlinePlayers as $data) {
                                echo "<tr>";
                                echo "<td>". $data[4] ."</td>";
                                echo "<td>". $data[1] ."</td>";
                                echo "<td>". $data[2] ." ms</td>";
                                echo "<td>". $data[3] ."</td>";
                                if ($user->hasPermision("BanTmp") || $user->hasPermision("BanPerm") || $user->hasPermision("BanKick")) {
                                    echo "<td>";
                                    if ($user->hasPermision("BanPerm")) {
                                        echo "<a href='javascript:void(0)' guid='". $data[3] ."' name='". $data[4] ."' rconid='". $data[0] ."' class='ban-player'><i class='fa fa-gavel pull-right' title='Banen'></i>";
                                    }
                                    if ($user->hasPermision("BanTmp")) {
                                        echo "<a href='javascript:void(0)' guid='". $data[3] ."' name='". $data[4] ."' rconid='". $data[0] ."' class='tempban-player'><i class='fa fa-clock-o pull-right' title='Temp-banen'></i>";
                                    }
                                    if ($user->hasPermision("BanKick")) {
                                        echo "<a href='javascript:void(0)' id='". $data[0] ."' name='". $data[4] ."' class='kick-player'><i class='fa fa-ban pull-right' title='Kicken'></i>";
                                    }
                                    echo "</td>";
                                };
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