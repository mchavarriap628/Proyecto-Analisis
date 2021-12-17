<?php
include 'cn.php';
$valorSelect = $_POST['removerConductorDB'];
//echo $valorSelect;
$sql = "DELETE FROM Usuario WHERE Nombre='$valorSelect';";
$stmt = sqlsrv_query($conn,$sql);
sqlsrv_free_stmt($stmt);
header('Location: ../../admin.php');
?>