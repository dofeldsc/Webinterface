<?php
  $rcon = new Rcon('164.132.204.214', 'EcqRh4TAJck6Kv3307');
?>
<div class="content-header">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
        <li class="active"><a href="<?php echo DE100_DOMAIN ;?>index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
                    <span class="info-box-number"><?php echo count ($rcon->getPlayersArray()) ?> </span>
                </div>
            </div>
        </div>
      </div>
    <div class="row">
      <div class="col-md-9 col-s-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Neue Spieler</h3>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="newPlayerChart"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-s-12">
        <div class="box box-primary">
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
              <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
              <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
              <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="home">
                <div class="box-header with-border">
                 <h3>Home</h3>
                </div>
                <div class="box-body">
                  <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Task</th>
                  <th>Progress</th>
                  <th style="width: 40px">Label</th>
                </tr>
                <tr>
                  <td>1.</td>
                  <td>Update software</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-red">55%</span></td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>Clean database</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-yellow">70%</span></td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Cron job running</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-light-blue">30%</span></td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Fix and squish bugs</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-green">90%</span></td>
                </tr>
              </table>
           
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="profile">...</div>
              <div role="tabpanel" class="tab-pane" id="messages">...</div>
              <div role="tabpanel" class="tab-pane" id="settings">...</div>
            </div>
      </div>
    </div>
  </div>
</div>
