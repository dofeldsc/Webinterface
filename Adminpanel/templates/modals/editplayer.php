<?php 
    $array = toPhpArray($playerInfo['aliases']);
    if (gettype($array[0]) == 'string') {
        $array = [
            [
                [
                    'To Old',
                    'To Old'
                ],
                $array[0]
            ]
        ];
    }
?>
<div class="modal fade" id="aliases" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-tags"></i> Decknamen(<?php echo count($array);?> Stk.)-Übersicht
                </h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Erstes Erscheinen</th>
                            <th>Letzte Verbindung</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($array as $name) {
                            echo "<tr>";
                            echo "<th>". $name[0][0] ."</th>";
                            echo "<th>". $name[0][1] ."</th>";
                            echo "<th>". $name[1] ."</th>";
                            echo "</tr>";
                        };
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="reset">Schließen</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ban" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="nav-tabs-custom tab-danger">
                <ul class="nav nav-tabs" role="tablist">
                    <?php if($user->hasPermision("BanTmp")):?>
                        <li role="presentation" class="<?php echo ($user->hasPermision("BanTmp"))? "active": "" ;?>"><a href="#Temp" aria-controls="Temp" role="tab" data-toggle="tab">Temporäre Bannen</a></li>
                    <?php endif;?>
                    <?php if($user->hasPermision("BanPerm")):?>
                        <li role="presentation" class="<?php echo (!$user->hasPermision("BanTmp") && $user->hasPermision("BanPerm"))? "active": "" ;?>"><a href="#Perm" aria-controls="Perm" role="tab" data-toggle="tab">Permanent Bannen</a></li>
                    <?php endif;?>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane <?php echo ($user->hasPermision("BanTmp"))? "active": "" ;?>" id="Temp">
                        <div class="box-header with-border">
                            <h3>Temporär Bannen</h3>
                        </div>
                        <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <h5 class="Text">Wie lange möchtest du den Spieler <strong><?php echo $playerInfo['name'];?></strong> temporäre bannen?</h5>
                                <span class="help-block">Sollte der Spieler online sein, wird er nicht automatisch gekickt.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Bannen bis:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Grund:</label>
                            <textarea class="form-control reason-text-tmpban" rows="3" placeholder="Grund ..."></textarea>
                            <span class="help-block">Adminname wird automatisch hinzugefügt</span>
                        </div>                
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Abbrechen</button>
                            <button type="button" class="btn confirm-tmpban-btn btn-danger pull-right">Temporär bannen</button>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane <?php echo (!$user->hasPermision("BanTmp") && $user->hasPermision("BanPerm"))? "active": "" ;?>" id="Perm">
                        <div class="box-header with-border">
                            <h3>Permanent Bannen</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h5 class="Text">Spieler <strong><?php echo $playerInfo['name'];?></strong> wirklich permanent bannen?</h5>
                                    <span class="help-block">Sollte der Spieler online sein, wird er nicht automatisch gekickt.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Grund:</label>
                                <textarea class="form-control reason-text-ban" rows="3" placeholder="Grund ..."></textarea>
                                <span class="help-block">Adminname wird automatisch hinzugefügt</span>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Abbrechen</button>
                            <button type="button" class="btn confirm-ban-btn btn-danger pull-right">Permanent bannen</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bans" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-history"></i> Ban-Historie
                </h4>
            </div>
            <div class="modal-body">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <?php foreach ($player->getBans($playerInfo['playerid']) as $ban):?>
                    <div class="panel box box-<?php echo ($ban['datum'] > 0) ? (($ban['status'] == 'false')? "success":"warning") : (($ban['status'] == 'false')?"success":"danger") ;?>">
                        <div class="panel-heading" role="tab" id="heading<?php echo $ban['id']; ?>">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#id_<?php echo $ban['id']; ?>" aria-expanded="true" aria-controls="collapseOne">
                                    <?php
                                        $type = ($ban['datum'] > 0) ? "Temp-Ban" : "Perma-Ban";
                                        echo $type." von ".$ban['von'];
                                        echo ($ban['status'] == 'true')? "<span class='text-red pull-right'>Gebannt</span>" : "<span class='text-green pull-right'>Entbannt</span>";
                                    ?>
                                </a>
                            </h4>
                        </div>
                        <div id="id_<?php echo $ban['id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $ban['id']; ?>">
                            <div class="panel-body">
                                <div class="col-xs-4">
                                    <strong>Gebannt von:</strong><br><div><?php echo $ban['von']; ?></div>
                                    
                                    <strong>Ban-Datum:</strong><br><div><?php echo $ban['insert_time'] ? date("d.m.Y H:i:s", strtotime($ban['insert_time'])) : "Keine Information"; ?></div>

                                    <strong>Gebannt bis:</strong><br><div><?php echo toDate($ban['datum']); ?></div>

                                    <strong>Ban-Status:</strong><br><div><?php echo ($ban['status'] == 'true')? "<span class='text-red'>Gebannt</span>" : "<span class='text-green'>Entbannt</span>"; ?></div>
                                </div>
                                <div class="col-xs-8">
                                    <strong>Grund:</strong><br><div><?php echo $ban['grund']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="reset">Schließen</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="transfer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Daten werden übermittelt...</h4>
            </div>
            <div class="modal-body">
                <div class="progress">
                  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                    40%
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="money" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-money"></i> Geld erstatten
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h5>Bitte gib den Betrag ein, der dem Bankkonto von <strong><?php echo $playerInfo['name'];?></strong> hinzugefügt werden soll.</h5>
                    </div>
                </div>
                <form method="post">
                    <div class="form-group">
                        <label>Geld hinzufügen</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="number" class="form-control pull-right" name="added_money">
                        </div>
                        <span class="help-block">Beachte, dass negative Werte vom Bankkonto abgezogen werden.</span>
                    </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Abbrechen</button>
                    <button type="submit" name="edit_money" class="btn btn-danger">Erstatten</button>
                </form>
            </div>
        </div>
    </div>
</div>