<?php


$serverName = "localhost"; // MANUEL

// La conexión se hace con las credenciales de windows sunbros.
$connectionInfo = array( "Database"=>"StarBusk");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

/*if( $conn ) {
     echo "Conexión establecida.<br />";
}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}*/

?>