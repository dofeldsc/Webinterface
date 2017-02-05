<?php
if (!$rcon->connected) {
    $pc = "Keine Verbindung zum Server";
} else {
    $pc = count ($rcon->getPlayersArray());
}

?>
<div class="content-header">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
        <li class="active"><a href="<?php echo DE100_DOMAIN ;?>"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
    </ol>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Neuster Spieler</span>
                    <span class="info-box-number"><?php echo Player::getNewestPlayer() ?> </span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Gelistete Spieler</span>
                    <span class="info-box-number"><?php echo number_format(Player::countPlayers(),0, ",", ".");  ?></span>
                </div>
            </div>
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-car"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Gelistete Fahrzeuge</span>
                    <span class="info-box-number"><?php echo number_format(Vehicle::countVehicles(),0, ",", ".");  ?> </span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-eye"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Online Spieler</span>
                    <span class="info-box-number"><?php echo $pc ?> </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 col-s-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" id="DataSets" dataSet="0">Spieler der letzten 24 Stunden</h3>
                    <div class="box-tools pull-right hidden-xs">
                        <select class="form-control pull-right" id="timeScale">
                            <option selected value="144">24 Stunden</option>
                            <option value="72">12 Stunden</option>
                            <option value="12">2 Stunden</option>
                        </select>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="newPlayerChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-s-12">
            <?php if (!$user->is_player()): ?>
            <div class="box box-primary">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#topBan" aria-controls="home" role="tab" data-toggle="tab">Bans verteilt</a>
                    </li>
                    <li role="presentation"><a href="#topBans" aria-controls="profile" role="tab" data-toggle="tab">Bans gesammelt</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="topBan">
                        <div class="box-header with-border">
                            <h3>Bans verteilt</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Team-Mitglied</th>
                                    <th>Anzahl</th>
                                </tr>
                                <?php 
                                  $c = 1;
                                  foreach ($user->topBans() as $bans) {
                                    echo "<tr>";
                                    echo "<td>".$c."</td>";
                                    echo "<td>".$bans['von']."</td>";
                                    echo "<td>".$bans['counter']." Bans</td>";
                                    echo "</tr>";
                                    $c = $c +1;
                                  }
                                ?>
                            </table>

                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="topBans">
                        <div class="box-header with-border">
                            <h3>Bans gesammelt</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Spieler</th>
                                    <th>Anzahl</th>
                                </tr>
                                <?php 
                                  $c = 1;
                                  foreach (Player::topBans() as $bans) {
                                    echo "<tr>";
                                    echo "<td>".$c."</td>";
                                    echo "<td><a href='".DIR_TO_SITES."editplayer?id=".($bans['uid'] ? $bans['uid'] : "#")."'>".$bans['name']."</a></td>";
                                    echo "<td>".$bans['counter']." Bans</td>";
                                    echo "</tr>";
                                    $c = $c +1;
                                  }
                                ?>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>