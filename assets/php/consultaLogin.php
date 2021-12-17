<?php
session_start();
$_SESSION['loggedUser'];
$_SESSION['loggedUserID'];
$_SESSION['loggedEmail'];
$_SESSION['rol'];

include 'cn.php'; //esto es para usar la conexión ya creada en cn.php y no estarla creando cada vez que hacemos una consulta.


//Recibimos los datos del Login HTML y los almacenamos en una variable.
$correo = $_POST['correoElectronico'];
$contrasena = $_POST['contrasena'];

//Se crea la consulta
$sql = "SELECT Id_Usuario, Nombre, Rol FROM Usuario Where Correo='$correo' and Password='$contrasena'";
//Se hace la consulta a la base de datos
$stmt = sqlsrv_query($conn,$sql);

//Se declaran variables donde se guardará la información que responde la consulta.
$Id_Usuario="";
$nombre="";
$rol="";

if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    //echo $row['Rol']."<br />";
    $Id_Usuario = $row['Id_Usuario'];
    $nombre = $row['Nombre'];
    $rol = $row['Rol'];
}
sqlsrv_free_stmt( $stmt);

//Guardamos información importante en las variables de sesión para utilizar en cualquier momento.
$_SESSION['loggedUserID']=$Id_Usuario;
$_SESSION['loggedUser']=$nombre;
$_SESSION['loggedEmail']=$correo ;
$_SESSION['rol']=$rol;

//Se redireccione a una página en concreto de acuerdo al rol que responde la base de datos.
switch ($rol) {
    case "admin":
        //echo "Es admin";
        header('Location: ../../admin.php');
        break;
    case "cliente":
        //echo "Es cliente";
        header('Location: ../../cliente.php');
        break;
    case "conductor":
        //echo "Es conductor";
        header('Location: ../../conductor.php');
        break;
    default:
        //echo "Error de credenciales";
        function phpAlert($msg) {
            echo '<script type="text/javascript">alert("' . $msg . '")</script>';
        }
        phpAlert(   "Error de autenticación, credenciales no validas."   );
        header('Location: ../../login.html');
}

?>