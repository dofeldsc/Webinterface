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
$table = 'bank';
if (!Input::get('pid')) {
	die('{"error":"no ID was given"}');
}
$id = Input::get('pid');
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 
    	'db' => 'id', 
    	'dt' => 0 
    ),
    array( 
    	'db' => 'zeitpunkt',     
    	'dt' => 1,
    	'formatter' => function( $d, $row) {
    		return str_replace ("-",".", $d);
    	}
    ),
    array(
        'db'        => 'type',
        'dt'        => 2,
        'formatter' => function( $d, $row ) {
			if ($row['sender'] != $_GET['pid']) {
				return "e. Überweisung";
			}
			switch ($d) {
			    case 0:
			        return "Überweisung";
			    case 1:
			        return "Auszahlung";
			    case 2:
			        return "Einzahlung";
			    case 3:
			        return "Gang-Einzahlung";
			    case 4:
			        return "Gang-Auszahlung";
			    default:
			        return "N/A";
			}
        }
    ),
    array( 
    	'db' => 'sender',  
    	'dt' => 3 
    ),
    array(
        'db'        => 'receiver',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {
            if ($d == $_GET['pid']) {
            	 return "N/A";
            } else {
            	 return "<a target='_blank' href='".DIR_TO_SITES."editplayer?id=".Player::PIDtoUID($d)."'>".Player::nameFromPID($d)."</a>";
            }
            
        }
    ),
    array( 
    	'db' => 'menge',     
    	'dt' => 3 ,
    	'formatter' => function($d, $row) {
    		return '$'.number_format($d,0, ",", ".");
    	}
    ),
    array(
    	'db' => 'verwendungszweck',
        'dt' => 5,
        'formatter' => function($d, $row) {
    		if ($row['type'] == 0) {
    			return trim($d, '"');
    		} else {
    			return "N/A";
    		}
    		
    	}
    ),
    array( 
    	'db' => 'sender_name', 
    	'dt' => 6
    ),
    array( 
    	'db' => 'receiver_name', 
    	'dt' => 7
    )
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
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns,NULL,"'$id' IN (`sender`,`receiver`)" )
);