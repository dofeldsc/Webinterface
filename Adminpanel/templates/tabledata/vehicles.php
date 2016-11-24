<?php
 require(dirname(dirname(dirname(__FILE__))) . '/includes/bootstrap.php');

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
// DB table to use
$table = 'vehicles';

// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array(
        'db'        => '`v`.`classname`',
        'field' 	=> 'classname',
        'dt'        => 0,
        'formatter' => function( $d, $row ) {
            return Vehicle::getVehName($d);
        }
    ),
    array(
        'db'        => '`v`.`type`',
        'field' 	=> 'type',
        'dt'        => 1,
        'formatter' => function( $d, $row ) {
            return Vehicle::convertType($d);
        }
    ),
    array(
        'db'        => '`v`.`side`',
        'field' 	=> 'side',
        'dt'        => 2,
        'formatter' => function( $d, $row ) {
            return Vehicle::convertSide($d);
        }
    ),
    array(
        'db'        => '`v`.`zeitpunkt`',
        'field'     => 'zeitpunkt',
        'dt'        => 3,
        'formatter' => function( $d, $row ) {
            if ($d) {
                return date("d.m.Y H:i", strtotime($d));
            } else {
                return "Keine Information";
            }
            
        }
    ),
    array( 'db' => '`p`.`name`', 'dt' => 4 ,'field' => 'name' ),
    array( 'db' => '`p`.`playerid`', 'dt' => 5 ,'field' => 'playerid' ),
    array(
        'db'        => '`v`.`alive`',
        'field'     => 'alive',
        'dt'        => 6,
        'formatter' => function( $d, $row ) {
            if ($d == 1) {
                return '<span class="label label-success">Okay</span>';
            } else {
                return '<span class="label label-danger">Zerstört</span>';
            }
        }
    ),
    array(
        'db'        => '`v`.`active`',
        'field'     => 'active',
        'dt'        => 7,
        'formatter' => function( $d, $row ) {
            if ($d == 1) {
                return '<span class="label label-danger">Ausgeparkt</span>';
            } else {
                return '<span class="label label-success">Geparkt</span>';
            }
        }
    ),
    array(
        'db'        => '`v`.`chopShop`',
        'field'     => 'chopShop',
        'dt'        => 8,
        'formatter' => function( $d, $row ) {
            if ($d) {
                return '<span class="label label-danger">Verkauft</span>';
            } else {
                return '<span class="label label-success">Nein</span>';
            }
        }
    ),
    array(
        'db'        => '`v`.`fuel`',
        'field'     => 'fuel',
        'dt'        => 9,
        'formatter' => function( $d, $row ) {
            if ($d >= .66) {
                $c = "success";
            } elseif ($d >= .33) {
                $c = "warning";
            } elseif ($d >= .0) {
                $c = "danger";
            }
            $d = $d * 100 . '%';
            return '<div class="progress progress-sm">
                <div class="progress-bar progress-bar-'.$c.' progress-bar-striped active" style="width: '.$d.'"></div>
            </div>';
        }
    ),
    array( 'db' => '`v`.`id`', 'dt' => 10 ,'field' => 'id' ),
);
 
$joinQuery = "FROM `{$table}` AS `v` LEFT JOIN `players` AS `p` ON (`v`.`pid` = `p`.`playerid`)";

// SQL server connection information
$sql_details = array(
    'user' => 'Lucian',
    'pass' => 'q-r.CT]EBv7*RhijZ.n,tE&XAy)#vi}P',
    'db'   => 'arma_main_server',
    'host' => '164.132.204.214'
);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery)
);