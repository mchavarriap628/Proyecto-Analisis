<?php
include 'cn.php';
$ruta = $_POST['rutaParaAsignar'];
$conductor = $_POST['conductorParaAsignar'];

$sql = "UPDATE Rutas SET conductorAsignado = '$conductor' WHERE nombre_ruta = '$ruta';";
$stmt = sqlsrv_query($conn,$sql);
sqlsrv_free_stmt($stmt);
header('Location: ../../admin.php');

?>