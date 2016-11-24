<div class="modal fade" id="aliases" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-font"></i> Decknamen-Übersicht
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
