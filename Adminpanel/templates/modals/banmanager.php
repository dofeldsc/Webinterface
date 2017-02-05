<div id="ReasonModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-comment"></i> Ban Grund:</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h5 class="Text"></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="UnbanModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-eraser"></i> Spieler entbannen?</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="Text"></h4>
                        <div class="form-group">
                            <label>Grund:</label>
                            <textarea class="form-control reason-text-unban" rows="3" placeholder="Grund ..."></textarea>
                        </div>   
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Abbrechen</button>
                <button type="button" class="btn confirm-unban-btn btn-success" id="">Entbannen</button>
            </div>
        </div>
    </div>
</div>

<div id="EditModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-wrench"></i> Ban bearbeiten</h4>
            </div>
            <div class="nav-tabs-custom tab-danger">
                <ul class="nav nav-tabs" role="tablist">
                    <?php if($user->hasPermision("BanTmp")):?>
                        <li id="TmpTab" role="presentation" class="<?php echo ($user->hasPermision("BanTmp"))? "active": "" ;?>"><a href="#TmpContent" aria-controls="Temp" role="tab" data-toggle="tab">Temporäre Bannen</a></li>
                    <?php endif;?>
                    <?php if($user->hasPermision("BanPerm")):?>
                        <li id="PermTab" role="presentation" class="<?php echo (!$user->hasPermision("BanTmp") && $user->hasPermision("BanPerm"))? "active": "s" ;?>"><a href="#PermContent" aria-controls="Perm" role="tab" data-toggle="tab">Permanent Bannen</a></li>
                    <?php endif;?>
                </ul>
                <div class="tab-content">
                    <div id="TmpContent" role="tabpanel" class="tab-pane <?php echo ($user->hasPermision("BanTmp"))? "active": "" ;?>" id="Temp">
                        <div class="box-header with-border">
                            <h3>Temporär Bannen</h3>
                        </div>
                        <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <h5 class="Text">Wie lange möchtest du den Spieler <strong class="Name"></strong> temporäre bannen?</h5>
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

                    <div id="PermContent" role="tabpanel" class="tab-pane <?php echo (!$user->hasPermision("BanTmp") && $user->hasPermision("BanPerm"))? "active": "" ;?>" id="Perm">
                        <div class="box-header with-border">
                            <h3>Permanent Bannen</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h5 class="Text">Spieler <strong class="Name"></strong> wirklich permanent bannen?</h5>
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