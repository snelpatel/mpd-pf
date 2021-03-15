<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$serverName = "52.26.5.98\\sqlexpress, 1433"; //serverName\instanceName, portNumber (default is 1433)
$connectionInfo = array( "Database"=>"nelson", "UID"=>"nelson", "PWD"=>"E#5kG!23*Rtm");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

?>