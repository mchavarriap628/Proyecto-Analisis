<?php
include 'cn.php';
$valorSelect = $_POST['removerRutaDB'];
//echo $valorSelect;
$sql = "DELETE FROM Rutas WHERE nombre_ruta='$valorSelect';";
$stmt = sqlsrv_query($conn,$sql);
sqlsrv_free_stmt($stmt);
header('Location: ../../admin.php');
?>