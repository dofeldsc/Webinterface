<?php
?>

<div class="content-header">
    <h1>Gangs</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Gangs</li>
    </ol>
</div>
<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
	            <div class="box-header with-border">
	                <h3 class="box-title">Gangs</h3>
	            </div>
	            <div class="box-body">
	                <table id="GangList" class="table table-striped table-hover table-bordered">
	                    <thead>
	                        <tr>
	                            <th>Name</th>
	                            <th>Gang-Bank</th>
	                            <th>Gang-Level</th>
	                            <?php if ($user->hasPermision("GangEdit")) :?>
	                            	<th><i class='fa fa-pencil pull-right'></i></th>
	                        	<?php endif; ?>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <?php
	                        	foreach ($gang->getGangs() as $gang) {
	                        		echo "<tr>";
	                        		echo "<td>".$gang['name']."</td>";
	                        		echo "<td>".'$'.number_format($gang['bank'])."</td>";
	                        		echo "<td>".$gang['level']."</td>";
	                                if ($user->hasPermision("GangEdit")) {
	                                    echo "<td>";
	                                    echo "<a href='" . DIR_TO_SITES . "editgang?id=" . $gang['id'] . "'><i class='fa fa-pencil pull-right' title='Bearbeiten'></i>";
	                                    echo "</td>";
	                                }
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