<?php
$articleName = Player::getItemName($articleData['class']);
?>

<div class="content-header">
    <h1>Artikle-Details</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Inventar</li>
        <li><a href="<?php echo DIR_TO_SITES ;?>auctions"> Auktionen</a></li>
        <li class="active">
            <?php echo $articleName;?>
        </li>
    </ol>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?php echo $articleName;?>
                    </h3>
                </div>
                <div class="box-body box-profile">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Verkäufer</b> <p class="pull-right"><?php echo $articleData['owner_name']; ?></p>
                        </li>
                        <li class="list-group-item">
                            <b>Sofortkauf Preis</b> <p class="pull-right">$<?php echo number_format($articleData['buynow'],0, ".", ","); ?></p>
                        </li>
                        <li class="list-group-item">
                            <b>Startpreis</b> <p class="pull-right">$<?php echo number_format($articleData['startPrice'],0, ".", ","); ?></p>
                        </li>
                        <li class="list-group-item">
                            <b>Aktuelles Gebot</b> <p class="pull-right" id="currentPrice">$<?php echo number_format($articleData['currentPrice'],0, ".", ","); ?></p>
                        </li>
                        <li class="list-group-item">
                            <b id="holderTitle"><?php echo ($articleData['sold'] == 0)? "Höchstbietender": "Käufer"; ?></b> <p class="pull-right" id="currentHolder"><?php echo ($articleData['currentHolder_name'])? $articleData['currentHolder_name']:"Startgebot"; ?></p>
                        </li>
                        <li class="list-group-item">
                            <b>Online seit</b> <p class="pull-right"> <?php echo date("d.m.Y H:i", strtotime($articleData['startDate'])); ?></p>
                        </li>
                        <li class="list-group-item">
                            <b>Restzeit</b> <p class="pull-right" id="expireCountDown"></p>
                        </li>
                    </ul>
                    <p class="col-xs-12"></p>
                    <?php if ($user->steamID() != $articleData['seller'] && $user->isLoggedIn()): ?>
                        <a href="#bet" data-toggle="modal" class="btn btn-warning btn-block btn-flat col-xs-12" <?php echo ($articleData['sold'] == 0)? "": "disabled"; ?>><b>Bieten</b></a>
                    	<a id="buyNow" class="btn btn-danger btn-block btn-flat col-xs-12" <?php echo ($articleData['sold'] == 0)? "": "disabled"; ?>><b>Sofortkauf</b></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            	<div class="box box-info">
            		<div class="box-header with-border">
	                    <h3 class="box-title">
	                        Gebot-Historie
	                    </h3>
	                </div>
	                <div class="box-body table-responsive">
						<table id="BetHistory" class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                	<th>ID</th>
                                    <th>Spieler</th>
                                    <th>Gebot</th>
                                    <th>Zeitpunkt</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<tr>
                            	<td>0</td>
                            	<td><?php echo $articleData['owner_name']; ?></td>
								<td>$<?php echo number_format($articleData['startPrice'],0, ".", ","); ?></td>
								<td><?php echo date("d.m.Y H:i", strtotime($articleData['startDate'])); ?></td>
                            	</tr>
                                <?php
                                    foreach ($article->getBetHistory() as $his) {
                                        echo "<tr>";
                                        echo "<td>".$his['id']."</td>";
                                        echo "<td>".$his['person_name']."</td>";
                                        echo "<td>".((is_numeric($his['amount']))? "$".number_format($his['amount'],0, ".", ",") : $his['amount'])."</td>";
                                        echo "<td>".date("d.m.Y H:i", strtotime($his['timestamp']))."</td>";
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