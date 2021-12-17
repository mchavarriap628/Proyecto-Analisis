<?php
include 'cn.php';
$nuevoPrecio = $_POST['NuevoPrecio'];
$rutaModificada = $_POST['rutaModificandoPrecio'];
//echo $nuevoPrecio;
//echo $rutaModificada;

$sql = "UPDATE Rutas SET precioRuta = '$nuevoPrecio' WHERE nombre_ruta = '$rutaModificada';";
$stmt = sqlsrv_query($conn,$sql);
sqlsrv_free_stmt($stmt);
header('Location: ../../admin.php');
?>