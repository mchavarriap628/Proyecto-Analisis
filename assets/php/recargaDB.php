<?php
//Se valida la sesión
session_start();
error_reporting(0);
include 'cn.php';
$loggedUser = $_SESSION['loggedUser'];
$loggedUserID = $_SESSION['loggedUserID'];
$loggedEmail = $_SESSION['loggedEmail'];
$rol = $_SESSION['rol'];

//Validación de login
if ($loggedUser == null || $loggedUserID == '' || $rol!='cliente') {
  echo "Error de autenticación, por favor inicie sesión.";
  die();
}

//Se define la zona horaria y se obtiene la fecha
date_default_timezone_set('America/Costa_Rica');
//$fecha = date("m.d.y");
$fecha = date('l jS \of F Y h:i:s A');

//Se recibe el correo y el monto a recargar
$correo = $_POST['email'];
$monto = $_POST['monto'];

//se obtiene el saldo del usuario al que se le va a recargar
$saldoDisponible=0;
$sql = "SELECT saldoDisponible FROM Saldo WHERE correoUsuario='$correo'";
$stmt = sqlsrv_query($conn,$sql);
if( $stmt === false ) {
  die( print_r( sqlsrv_errors(), true));
}
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
  $saldoDisponible = $row['saldoDisponible'];
}
sqlsrv_free_stmt( $stmt);

//Se suma el saldo obtenido con el que se va a recargar
$nuevoSaldo = $monto + $saldoDisponible;

//Se actualiza el nuevo saldo en la base de datos
$sqlDos = "UPDATE Saldo SET saldoDisponible = '$nuevoSaldo' WHERE correoUsuario='$correo'";
$stmt = sqlsrv_query($conn,$sqlDos);
sqlsrv_free_stmt($stmt);

//Se registra la transacción en la tabla Recargas
$sqlTres = "INSERT INTO Recargas(correo,monto,fecha) VALUES ('$correo','$monto','$fecha')";
$stmt = sqlsrv_query($conn,$sqlTres);
sqlsrv_free_stmt($stmt);

//Saldo actualizado, redirigiendo al pagina principal de cliente.
header('Location: ../../cliente.php');

