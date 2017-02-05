<?php
$stocks = $stock->data();
?>
<div class="content-header">
    <h1>Börse</h1>
    <ol class="breadcrumb">
        <li class="active"><a href="<?php echo DE100_DOMAIN ;?>"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="active">
        	Börse
        </li>
    </ol>
</div>

<div class="content">
	<?php foreach($stocks as $item):?>
	<div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" id="<?php echo $item['Item'] ?>_title"><?php echo Player::getItemName($item['Item']) ?>-Preis 24 Stunden</h3>
                    <div class="box-tools pull-right">
                        <select class="form-control box-tools timeScale" varname="<?php echo $item['Item'] ?>" displayName="<?php echo Player::getItemName($item['Item'])?>">
                            <option value="-1">All-Time</option>
                            <option selected value="144">24 Stunden</option>
                            <option value="72">12 Stunden</option>
                            <option value="12">2 Stunden</option>
                        </select>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <div class="overlay" id="<?php echo $item['Item'] ?>_spinner">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                        <canvas id="<?php echo $item['Item'] ?>" class="stock_chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<?php endforeach; ?>
</div>