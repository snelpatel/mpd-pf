<?php 

//Note: This file should be included first in every php page.

define('BASE_PATH', dirname(dirname(__FILE__)));
define('APP_FOLDER','paindiagnosis');
define('CURRENT_PAGE', basename($_SERVER['REQUEST_URI']));


/*
|--------------------------------------------------------------------------
| DATABASE CONFIGURATION
|--------------------------------------------------------------------------
*/
$serverName = "52.26.5.98\\sqlexpress, 1433";
$connectionInfo = array( "Database"=>"nelson", "UID"=>"nelson", "PWD"=>"E#5kG!23*Rtm");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

?>