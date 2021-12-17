<?php
//Se valida la sesión
session_start();
error_reporting(0);
include 'cn.php';
$loggedUser = $_SESSION['loggedUser'];
$loggedUserID = $_SESSION['loggedUserID'];
$rol = $_SESSION['rol'];
//Validación de login
if ($loggedUser == null || $loggedUserID == '' || $rol!='conductor') {
  echo "Error de autenticación, por favor inicie sesión.";
  die();
}
//Se define la zona horaria y se obtiene la fecha
date_default_timezone_set('America/Costa_Rica');
$fecha = date("m.d.y");
//$fecha = date('l jS \of F Y h:i:s A');

//Recibimos los datos del Login HTML y los almacenamos en una variable.
$correoCliente = $_POST['emailCliente'];
$valorRuta = $_POST['valorRuta'];
$nombreRuta = $_SESSION['rutaAsignada'];

//Validamos que el cliente exista.
$idCliente=0;
$sql = "SELECT id FROM Saldo WHERE correoUsuario='$correoCliente'";
$stmt = sqlsrv_query($conn,$sql);
if( $stmt === false ) {
  die( print_r( sqlsrv_errors(), true));
}
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
  $idCliente = $row['id'];
}
sqlsrv_free_stmt( $stmt);
if ($idCliente<=0) {
    echo "El cliente al que le va a cobrar no existe en la base de datos.";
    header('Location: ../../clienteNoExiste.html');
    die();
}

//Si existe entonces verificamos su saldo para realizar el cobro.
$saldoDisponible=0;
$sqlDos = "SELECT saldoDisponible FROM Saldo WHERE correoUsuario='$correoCliente'";
$stmt = sqlsrv_query($conn,$sqlDos);
if( $stmt === false ) {
  die( print_r( sqlsrv_errors(), true));
}
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
  $saldoDisponible = $row['saldoDisponible'];
}
sqlsrv_free_stmt( $stmt);

//Evaluamos si el saldo disponible es suficiente para pagar el pasaje de la ruta
$puedePagar;
$nuevoSaldo;
if ($saldoDisponible < $valorRuta) {
    $puedePagar=false;
    //Calculamos lo que faltó para poder pagar los pasajes y sacamos su valor absoluto
    $nuevoSaldo = $saldoDisponible - $valorRuta;
    $nuevoSaldo = abs($nuevoSaldo);
}else {
    $puedePagar=true;
    //Calculamos el nuevo saldo
    $nuevoSaldo = $saldoDisponible - $valorRuta;
}

//Guardamos el nuevo saldo como variable global
$_SESSION['nuevoSaldo'] = $nuevoSaldo;


//Se realiza el cobro en Saldo, se registra en Pagos o se guarda el registro en la tabla de Rechazos
if ($puedePagar) {
    //Se aplica el rebajo de la tabla saldo
    $sqlTres = "UPDATE Saldo SET saldoDisponible = '$nuevoSaldo' WHERE correoUsuario='$correoCliente'";
    $stmt = sqlsrv_query($conn,$sqlTres);
    sqlsrv_free_stmt($stmt);

    //Se registra la transacción en la tabla Pagos
    $sqlCuatro = "INSERT INTO Pagos(correo,monto,fecha,ruta) VALUES ('$correoCliente','$valorRuta','$fecha','$nombreRuta')";
    $stmt = sqlsrv_query($conn,$sqlCuatro);
    sqlsrv_free_stmt($stmt);

    guardarReporte($fecha, $loggedUser, $nombreRuta, $correoCliente, $valorRuta, $puedePagar);
    //Cobro realizado y registrado, se redirecciona a la pestaña anterior para cobrarle a alguien más.
    header('Location: ../../conductor.php');
}else {
    $sqlTres = "INSERT INTO Rechazos(correo,falto,fecha,ruta) VALUES ('$correoCliente','$nuevoSaldo','$fecha','$nombreRuta');";
    $stmt = sqlsrv_query($conn,$sqlTres);
    sqlsrv_free_stmt($stmt);

    guardarReporte($fecha, $loggedUser, $nombreRuta, $correoCliente, $valorRuta, $puedePagar);
    //Redirección a página de cobro NO realizado, cliente RECHAZADO
    header('Location: ../../errorPago.php');
}











//Se crea la función para guardar toda la transacción en los reportes para el administrador
function guardarReporte($fecha, $loggedUser, $nombreRuta, $correoCliente, $valorRuta, $puedePagar){
    //conexión requerida
    include 'cn.php';

    //Se confirma la existencia del registro en la base de datos, si existe se realiza el update, si no entonces se crea
    $idRegistro=0;
    
    //$registroExiste;
    $sqlValidacionRegistro = "SELECT id FROM Reportes WHERE fecha='$fecha' and conductor='$loggedUser'";
    $stmt = sqlsrv_query($conn,$sqlValidacionRegistro);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $idRegistro = $row['id'];
      }
    sqlsrv_free_stmt( $stmt);

    //Se crea el registro o se procede con el update de los datos
    if ($idRegistro<=0) {
        if ($puedePagar) { //No existe y el cliente pagó
            $sqlNoExistePaga = "INSERT INTO Reportes(fecha,conductor,recaudado,rechazados,ruta) VALUES ('$fecha','$loggedUser','$valorRuta','0','$nombreRuta');";
            $stmt = sqlsrv_query($conn,$sqlNoExistePaga);
            sqlsrv_free_stmt($stmt);
        } else { //No existe y el cliente no pagó
            $sqlNoExisteNoPaga = "INSERT INTO Reportes(fecha,conductor,recaudado,rechazados,ruta) VALUES ('$fecha','$loggedUser','0','1','$nombreRuta');";
            $stmt = sqlsrv_query($conn,$sqlNoExisteNoPaga);
            sqlsrv_free_stmt($stmt);
        }

    }else {
        if ($puedePagar) { //Sí existe y el cliente pagó
            //Se obtiene el recaudado actual
            $recaudadoDB=0;
            $sqlRecaudado = "SELECT recaudado FROM Reportes WHERE fecha='$fecha' and conductor='$loggedUser';";
            $stmt = sqlsrv_query($conn,$sqlRecaudado);
            if( $stmt === false ) {
                die( print_r( sqlsrv_errors(), true));
            }
            while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                $recaudadoDB = $row['recaudado'];
              }
            sqlsrv_free_stmt( $stmt);
            $nuevoRecaudado = $recaudadoDB + $valorRuta;
            //Se actualiza con el recaudado actualizado
            $sqlUpdateRecaudado = "UPDATE Reportes set recaudado='$nuevoRecaudado' WHERE fecha='$fecha' and conductor='$loggedUser';";
            $stmt = sqlsrv_query($conn,$sqlUpdateRecaudado);
            sqlsrv_free_stmt($stmt);

        } else { //Sí existe y el cliente no pagó
            //Se obtiene el rechazados actual
            $rechazadosDB=0;
            $sqlRechazados = "SELECT rechazados FROM Reportes WHERE fecha='$fecha' and conductor='$loggedUser';";
            $stmt = sqlsrv_query($conn,$sqlRechazados);
            if( $stmt === false ) {
                die( print_r( sqlsrv_errors(), true));
            }
            while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                $rechazadosDB = $row['rechazados'];
              }
            sqlsrv_free_stmt( $stmt);
            $NuevoRechazados = $rechazadosDB + 1;
            //Se actualiza con el rechazados actualizado
            $sqlUpdateRechazados = "UPDATE Reportes set rechazados='$NuevoRechazados' WHERE fecha='$fecha' and conductor='$loggedUser';";
            $stmt = sqlsrv_query($conn,$sqlUpdateRechazados);
            sqlsrv_free_stmt($stmt);            
        }
    }

}

?>