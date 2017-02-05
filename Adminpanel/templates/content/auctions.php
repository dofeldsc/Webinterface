<?php
?>

<div class="content-header">
    <h1>Auktionshaus</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Inventar</li>
        <li class="active">Auktionshaus</li>
    </ol>
</div>
<div class="content">
    <div class="row">
        <div class="col-xs-12">	            	
            <div class="nav-tabs-custom tab-danger">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#wea" aria-controls="wea" role="tab" data-toggle="tab">Waffen</a></li>
                    <li role="presentation"><a href="#clo" aria-controls="clo" role="tab" data-toggle="tab">Kleidung</a></li>
                    <li role="presentation"><a href="#itm" aria-controls="itm" role="tab" data-toggle="tab">Items</a></li>
                    <li role="presentation"><a href="#res" aria-controls="res" role="tab" data-toggle="tab" id="trigger_trans">Sonstiges</a></li>
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
                                        <th>Item</th>
                                        <th>Verkäufer</th>
                                        <th>Sofortkauf</th>
                                        <th>Gebot</th>
                                        <th>Ablaufdatum</th>
                                        <th><i class='fa fa-shopping-cart pull-right'></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach (Auction::getAuctions('weapon') as $item) {
                                            echo "<tr>";
                                            echo "<td>".Player::getItemName($item['class'])."</td>";
                                            echo "<td>".$item['owner_name']."</td>";
                                            echo "<td>$".number_format($item['buynow'],0, ".", ",")."</td>";
                                            echo "<td>$".number_format($item['currentPrice'],0, ".", ",")."</td>";
                                            echo "<td>".date("d.m.Y H:i", strtotime($item['expireDate']))."</td>";
                                            echo "<td><a href='".DIR_TO_SITES."article?id=".$item['a_id']."'><i class='fa fa-shopping-cart pull-right'></i></a></td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
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
                                        <th>Item</th>
                                        <th>Verkäufer</th>
                                        <th>Sofortkauf</th>
                                        <th>Gebot</th>
                                        <th>Ablaufdatum</th>
                                        <th><i class='fa fa-shopping-cart pull-right'></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach (Auction::getAuctions('clothing') as $item) {
                                            echo "<tr>";
                                            echo "<td>".Player::getItemName($item['class'])."</td>";
                                            echo "<td>".$item['owner_name']."</td>";
                                            echo "<td>$".number_format($item['buynow'],0, ".", ",")."</td>";
                                            echo "<td>$".number_format($item['currentPrice'],0, ".", ",")."</td>";
                                            echo "<td>".date("d.m.Y H:i", strtotime($item['expireDate']))."</td>";
                                            echo "<td><a href='".DIR_TO_SITES."article?id=".$item['a_id']."'><i class='fa fa-shopping-cart pull-right'></i></a></td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
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
                                        <th>Item</th>
                                        <th>Verkäufer</th>
                                        <th>Sofortkauf</th>
                                        <th>Gebot</th>
                                        <th>Ablaufdatum</th>
                                        <th><i class='fa fa-shopping-cart pull-right'></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach (Auction::getAuctions('vitems') as $item) {
                                            echo "<tr>";
                                            echo "<td>".Player::getItemName($item['class'])."</td>";
                                            echo "<td>".$item['owner_name']."</td>";
                                            echo "<td>$".number_format($item['buynow'],0, ".", ",")."</td>";
                                            echo "<td>$".number_format($item['currentPrice'],0, ".", ",")."</td>";
                                            echo "<td>".date("d.m.Y H:i", strtotime($item['expireDate']))."</td>";
                                            echo "<td><a href='".DIR_TO_SITES."article?id=".$item['a_id']."'><i class='fa fa-shopping-cart pull-right'></i></a></td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
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
                                        <th>Item</th>
                                        <th>Verkäufer</th>
                                        <th>Sofortkauf</th>
                                        <th>Gebot</th>
                                        <th>Ablaufdatum</th>
                                        <th><i class='fa fa-shopping-cart pull-right'></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach (Auction::getAuctions('other') as $item) {
                                            echo "<tr>";
                                            echo "<td>".Player::getItemName($item['class'])."</td>";
                                            echo "<td>".$item['owner_name']."</td>";
                                            echo "<td>$".number_format($item['buynow'],0, ".", ",")."</td>";
                                            echo "<td>$".number_format($item['currentPrice'],0, ".", ",")."</td>";
                                            echo "<td>".date("d.m.Y H:i", strtotime($item['expireDate']))."</td>";
                                            echo "<td><a href='".DIR_TO_SITES."article?id=".$item['a_id']."'><i class='fa fa-shopping-cart pull-right'></i></a></td>";
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
    </div>
</div>