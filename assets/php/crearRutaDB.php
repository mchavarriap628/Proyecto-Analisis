<?php
include 'cn.php';

$id_ruta = 0;
$nombreRuta = $_POST['nuevaRutaNombre'];
$precioRuta = $_POST['nuevaRutaPrecio'];

$sql = "SELECT MAX(id_ruta) AS max FROM Rutas;";
$stmt = sqlsrv_query($conn,$sql);

if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    $id_ruta = $row['max'] + 1;
}

sqlsrv_free_stmt($stmt);

$sqlDos = "INSERT INTO Rutas (id_ruta, nombre_ruta, precioRuta) VALUES ('$id_ruta','$nombreRuta','$precioRuta');";
$stmt = sqlsrv_query($conn,$sqlDos);
sqlsrv_free_stmt($stmt);

header('Location: ../../admin.php');


?>