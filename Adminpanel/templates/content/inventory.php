<?php
?>

<div class="content-header">
    <h1>Online-Inventar</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Inventar</li>
        <li class="active">Online-Inventar</li>
    </ol>
</div>
<div class="content">
    <div class="row">
        <div class="col-xs-12">	            	
            <div class="nav-tabs-custom tab-danger">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#wea" aria-controls="wea" role="tab" data-toggle="tab">Waffen</a></li>
                    <li role="presentation"><a href="#clo" aria-controls="clo" role="tab" data-toggle="tab" id="trigger_clo">Kleidung</a></li>
                    <li role="presentation"><a href="#itm" aria-controls="itm" role="tab" data-toggle="tab" id="trigger_items">Items</a></li>
                    <li role="presentation"><a href="#res" aria-controls="res" role="tab" data-toggle="tab" id="trigger_oth">Sonstiges</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="wea">
                        <div class="box-header with-border">
                            <h3>Waffen</h3>
                        </div>
                        <div class="box-body table-responsive">             
                            <table id="WeaponList" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Item</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($player->getOnlineInventory('weapon') as $item) {
                                            echo "<tr>";
                                            echo "<td>".$item['id']."</td>";
                                            echo "<td>".$player::getItemName($item['class'])."</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer">
                            <a class="btn btn-success btn-flat" onclick="create_auction('weapon')">Auktion erstellen</a>
                            <a class="btn btn-danger btn-flat pull-right" onclick="send_to_game('weapon')">Ins Spiel senden</a>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="clo">
                        <div class="box-header with-border">
                            <h3>Kleidung</h3>
                        </div>
                        <div class="box-body table-responsive">
                        <table id="ClothingList" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Item</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($player->getOnlineInventory('clothing') as $item) {
                                            echo "<tr>";
                                            echo "<td>".$item['id']."</td>";
                                            echo "<td>".$player::getItemName($item['class'])."</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer">
                            <a class="btn btn-success btn-flat" onclick="create_auction('clothing')">Auktion erstellen</a>
                            <a class="btn btn-danger btn-flat pull-right" onclick="send_to_game('clothing')">Ins Spiel senden</a>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="itm">
                        <div class="box-header with-border">
                            <h3>Items</h3>
                        </div>
                        <div class="box-body table-responsive">
                            <table id="ItemList" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Item</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($player->getOnlineInventory('vitems') as $item) {
                                            echo "<tr>";
                                            echo "<td>".$item['id']."</td>";
                                            echo "<td>".$player::getItemName($item['class'])."</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer">
                            <a class="btn btn-success btn-flat" onclick="create_auction('items')">Auktion erstellen</a>
                            <a class="btn btn-danger btn-flat pull-right" onclick="send_to_game('items')">Ins Spiel senden</a>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="res">
                        <div class="box-header with-border">
                            <h3>Sonstiges</h3>
                        </div>
                        <div class="box-body table-responsive">
                            <table id="OtherList" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Item</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($player->getOnlineInventory('other') as $item) {
                                            echo "<tr>";
                                            echo "<td>".$item['id']."</td>";
                                            echo "<td>".$player::getItemName($item['class'])."</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer">
                            <a class="btn btn-success btn-flat" onclick="create_auction('other')">Auktion erstellen</a>
                            <a class="btn btn-danger btn-flat pull-right" onclick="send_to_game('other')">Ins Spiel senden</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>