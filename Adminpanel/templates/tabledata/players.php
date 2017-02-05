<?php
 
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
$table = 'players';
 
// Table's primary key
$primaryKey = 'uid';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'name', 'dt' => 0 ),
    array( 'db' => 'playerid',  'dt' => 1 ),
    array(
        'db'        => 'cash',
        'dt'        => 2,
        'formatter' => function( $d, $row ) {
            return '$'.number_format($d);
        }
    ),
    array(
        'db'        => 'bankacc',
        'dt'        => 3,
        'formatter' => function( $d, $row ) {
            return '$'.number_format($d);
        }
    ),
    array( 'db' => 'adminlevel',     'dt' => 4 ),
    array( 'db' => 'coplevel',     'dt' => 5 ),
    array( 'db' => 'thrlevel',     'dt' => 6 ),
    array( 'db' => 'aliases',     'dt' => 7 ),
    array( 'db' => 'guid',     'dt' => 8 ),
    array( 'db' => 'uid',     'dt' => 9 )

);
 
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
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);