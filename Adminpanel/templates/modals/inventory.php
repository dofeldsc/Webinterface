<?php 
?>

<div class="modal fade" id="create_auction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-shopping-cart"></i> Angebot erstellen
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Artikel: <strong id="CA_articleDesc"></strong></h4>
                        <h5>Bitte fülle die unten stehenden Felder aus.</h5>
                        <span class="help-block">Beachte, dass die Erstellung eines Angebotes verbindlich ist und somit nicht rückgängig gemacht werden kann.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Gültig bis:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="CA_datepicker">
                    </div>
                    <span class="help-block">Beachte, dass ein Angebot minimal 2 Stunden gültig sein muss und maximal 72 Stunden gültig sein kann.</span>
                </div>

                <div class="form-group">
                    <label>Sofortkauf:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <input type="number" class="form-control pull-right" id="CA_buyNow">
                    </div>

                    <label>Startgebot:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <input type="number" class="form-control pull-right" id="CA_startBet">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Abbrechen</button>
                <button id="ca_create" class="btn btn-danger">Erstellen</button>
            </div>
        </div>
    </div>
</div>