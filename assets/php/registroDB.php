<?php
include('cn.php');
error_reporting(0);
//Se declara lo que se almacenará en la base de datos
$id_Usuario = 0;
$nombre = $_POST["Nombre"];
$correo = $_POST["Correo"];
$contrasena = $_POST["Password"];
$rol = "cliente";

//Se comprueba si el usuario ya existe o no
$existe = "";
$consultaExistencia = "SELECT Id_Usuario FROM Usuario where Correo='$correo';";
$stmt = sqlsrv_query($conn, $consultaExistencia);
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $existe = $row['Id_Usuario'];
}
sqlsrv_free_stmt($stmt);

if ($existe === "") {
    //No existe entonces se agrega
    //Se consulta cual es el ultimo ID para sumarle 1 y obtener el ultimo ID disponible
    $sql = "SELECT MAX(Id_Usuario) AS max FROM Usuario;";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $id_Usuario = $row['max'] + 1;
    }
    sqlsrv_free_stmt($stmt);

    //Se inserta en la DB la información obtenida del POST más el ID que se calculó anteriormente
    $sqlDos = "INSERT INTO Usuario (Id_Usuario, Nombre, Correo, Password, Rol) VALUES ('$id_Usuario','$nombre','$correo','$contrasena','$rol');";
    $stmt = sqlsrv_query($conn, $sqlDos);
    sqlsrv_free_stmt($stmt);

    //Se inserta en la DB el registro con el saldo incial de este cliente
    $saldoInicial = 0;
    $sqlTres = "INSERT INTO Saldo(correoUsuario,saldoDisponible) VALUES ('$correo','$saldoInicial');";
    $stmt = sqlsrv_query($conn, $sqlTres);
    sqlsrv_free_stmt($stmt);

    //Finaliza el registro y redirigimos al usuario al login
    header('Location: ../../login.html');
} else {
    //Sí existe entonces no se hace nada.
    header('Location: ../../errorCrearUsuario.html');
}
