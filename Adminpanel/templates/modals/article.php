<?php 
?>

<div class="modal fade" id="bet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-shopping-cart"></i> Bieten
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h5>Bitte gib den Betrag ein, den du bieten möchtest.</h5>
                    </div>
                </div>
                <form>
                    <div class="form-group">
                        <label>Betrag:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="number" class="form-control pull-right" id="bet_amount" value="<?php echo $articleData['currentPrice']; ?>">
                        </div>
                        <span class="help-block">Beachte, dass ein Gebot verbindlich ist und nicht rückgängig gemacht werden kann.</span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Abbrechen</button>
                <button id="bet_submitt" class="btn btn-danger">Bieten</button>
            </div>
        </div>
    </div>
</div>