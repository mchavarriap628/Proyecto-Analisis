<?php
//Se valida la sesión
session_start();
error_reporting(0);
include './assets/php/cn.php';
$loggedUser = $_SESSION['loggedUser'];
$loggedUserID = $_SESSION['loggedUserID'];
$rol = $_SESSION['rol'];
//Validación de login
if ($loggedUser == null || $loggedUserID == '' || $rol!='conductor' ) {
  echo "Error de autenticación, por favor inicie sesión.";
  die();
}

//Se obtiene la ruta asignada al conductor que hace login
$nombreRuta="No tiene una ruta asignada";
$sql = "SELECT nombre_ruta from Rutas WHERE conductorAsignado='$loggedUser'";
$stmt = sqlsrv_query($conn,$sql);
if( $stmt === false ) {
  die( print_r( sqlsrv_errors(), true));
}
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
  $nombreRuta = $row['nombre_ruta'];
}
sqlsrv_free_stmt( $stmt);

//Se guarda en variable de sesión la ruta que está realizando el conductor
$_SESSION['rutaAsignada']=$nombreRuta;

//se obtiene el precio de la ruta
$precioRuta="0";
$sqlDos = "SELECT precioRuta FROM Rutas WHERE nombre_ruta='$nombreRuta'";
$stmt = sqlsrv_query($conn,$sqlDos);
if( $stmt === false ) {
  die( print_r( sqlsrv_errors(), true));
}
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
  $precioRuta = $row['precioRuta'];
}
sqlsrv_free_stmt( $stmt);



?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <title>StarkBus - Conductor</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-plot-listing.css">
  <link rel="stylesheet" href="assets/css/animated.css">
  <link rel="stylesheet" href="assets/css/owl.css">

</head>

<body>

  <div class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="top-text header-text">
            <h1 class="p-3 mb-2 bg-info text-white">¡Bienvenido estimado <?php echo $_SESSION['loggedUser'] ?>!</h1>
            <h3 class="p-3 mb-2 bg-info text-white">Gracias por colaborar con nuestra empresa, es usted muy importante
              para nosotros</h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div style="margin-top: 50px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="inner-content">
            <div class="row">
              <div class="col-lg-6">
                <div id="map">
                  <iframe src="https://maps.google.com/maps?q=ulacit&t=&z=17&ie=UTF8&iwloc=&output=embed" width="100%"
                    height="650px" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
              </div>
              <div class="col-lg-6 align-self-center">

                <div class="progress">
                  <div class="progress-bar bg-info" style="width:100%"> </div>
                </div>

                <div class="row p-3">
                  <div class="col-lg-12" style="margin-top: 15px;">
                    <h1>Ruta de hoy:</h1>
                    <h3 style="margin-top: 15px; margin-bottom:15px; color: darkcyan;"><?php echo $nombreRuta; ?></h3>
                    
                    <!--Cobro a cliente-->
                    <div>
                      <form action="assets/php/cobro.php" method="POST">
                          <label for="emailCliente">Email del pasajero</label><br>
                          <input type="email" name="emailCliente" placeholder="pasajero@ya.com" required><br>
                          <label for="valorRuta">Precio del pasaje ₡</label><br>
                          <input type="text" value="<?php echo $precioRuta; ?>" name="valorRuta" readonly><br>
                          <input class="btn btn-success" type="submit" value="Realizar Cobro" style="margin-top: 15px;">
                      </form>
                    </div>

                    <a href="assets/php/cerrarSesion.php" class="btn btn-danger" style="margin-top: 100px;">Cerrar sesión</a>
                    <!--ruta-->
                  </div>



                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="col-lg-12">
        <div class="sub-footer">
          <p>Copyright © 2021 Starkbus Ltd. All Rights Reserved.
            <br>
        </div>
      </div>
    </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/animation.js"></script>
  <script src="assets/js/imagesloaded.js"></script>
  <script src="assets/js/custom.js"></script>

</body>

</html>