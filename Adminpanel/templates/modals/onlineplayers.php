<div id="KickPlayerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-ban"></i> Kicken</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h5 class="Text"></h5>
                    </div>
                </div>
                <div class="form-group">
                    <label>Grund:</label>
                    <textarea class="form-control reason-text-kick" rows="3" placeholder="Grund ..."></textarea>
                    <span class="help-block">Adminname wird automatisch hinzugefügt</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Abbrechen</button>
                <button type="button" class="btn confirm-kick-btn btn-danger" id="">Kicken</button>
            </div>
        </div>
    </div>
</div>

<div id="TempbanPlayerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-clock-o"></i> Temporär bannen</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h5 class="Text"></h5>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Abbrechen</button>
                <button type="button" class="btn confirm-tmpban-btn btn-danger">Temporär bannen</button>
            </div>
        </div>
    </div>
</div>

<div id="BanPlayerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-gavel"></i> Permanent Bannen</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h5 class="Text"></h5>
                    </div>
                </div>
                <div class="form-group">
                    <label>Grund:</label>
                    <textarea class="form-control reason-text-ban" rows="3" placeholder="Grund ..."></textarea>
                    <span class="help-block">Adminname wird automatisch hinzugefügt</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Abbrechen</button>
                <button type="button" class="btn confirm-ban-btn btn-danger">Bannen</button>
            </div>
        </div>
    </div>
</div>

<div id="TransferData" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-exchange"></i> Daten werden übermittelt...</h4>
            </div>
            <div class="modal-body">
                <div class="progress progress-xl">
                  <div class="progress-bar progress-bar-success progress-bar-striped active" style="width:100%">
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>