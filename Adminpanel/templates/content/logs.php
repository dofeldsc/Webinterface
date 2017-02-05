<?php
?>

<div class="content-header">
    <h1>Logs</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Logs</li>
    </ol>
</div>
<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
	            <div class="box-header with-border">
	                <h3 class="box-title">Logs</h3>
	            </div>
	            <div class="box-body">
		            <div class="row">	            	
	                    <div class="form-group has-feedback">
	                        <label class="col-md-12 control-label">Aktionen-Filtern:</label>
	                        <div class="col-md-12">
							<select class="form-control" id="actions">
								<option selected value="">Alle</option>
								<?php
									foreach (Logger::getLogTyps() as $type) {
										echo "<option value='" . Logger::getTypeName($type['action']) . "'>" . Logger::getTypeName($type['action']) . "</option>";
									}
								?>
							</select>
	                        </div>
	                    </div>
		            </div>
		            <br>
	                <table id="LogList" class="table table-striped table-hover table-bordered">
	                    <thead>
	                        <tr>
	                            <th>Benutzer</th>
	                            <th>Aktion</th>
	                            <th>Zeit</th>
	                            <th>Ziel</th>
	                            <th>Details</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <?php
	                        	foreach (Logger::getLogs() as $log) {
	                        		echo "<tr>";
	                        		echo "<td>".$log["username"]."</td>";
	                        		echo "<td>".Logger::getTypeName($log["action"])."</td>";
	                        		echo "<td>".date("d.m.Y H:i:s", $log["time"])."</td>";
	                        		if ($log["action"] == "gangEdit") {
	                        			echo "<td><a href='".DIR_TO_SITES."editgang?id=".$log['target']."'>".($log["gname"]? $log["gname"]:"Keine Infos")."</a></td>";
	                        		} else {
	                        			echo "<td><a href='".DIR_TO_SITES."editplayer?id=".$log['target']."'>".($log["pname"]? $log["pname"]:"Keine Infos")."</a></td>";
	                        		}
	                        		echo "<td>".$log["details"]."</td>";
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