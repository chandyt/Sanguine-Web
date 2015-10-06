<?php

$serverName = "54.210.175.98\DEV, 1435"; //serverName\instanceName, portNumber (default is 1433)
$connectionInfo = array( "Database"=>"Sanguine", "UID"=>"snguser", "PWD"=>"S@nguine");
$conn = sqlsrv_connect( $serverName, $connectionInfo);


if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

?>
