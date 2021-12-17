<?php
//Se valida la sesión
session_start();
error_reporting(0);
include './assets/php/cn.php';
$loggedUser = $_SESSION['loggedUser'];
$loggedUserID = $_SESSION['loggedUserID'];
$loggedEmail = $_SESSION['loggedEmail'];
$rol = $_SESSION['rol'];

//Validación de login
if ($loggedUser == null || $loggedUserID == '' || $rol!='cliente') {
  echo "Error de autenticación, por favor inicie sesión.";
  die();
}

//se obtiene el saldo del usuario logeado
$saldoDisponible=0;
$sqlDos = "SELECT saldoDisponible FROM Saldo WHERE correoUsuario='$loggedEmail'";
$stmt = sqlsrv_query($conn,$sqlDos);
if( $stmt === false ) {
  die( print_r( sqlsrv_errors(), true));
}
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
  $saldoDisponible = $row['saldoDisponible'];
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>StarkBus - Cliente</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-plot-listing.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">

  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <div class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="top-text header-text">
            <h1 class="p-3 mb-2 bg-info text-white">¡Hola <?php echo $_SESSION['loggedUser'] ?>!</h1>
            <h3 class="p-3 mb-2 bg-info text-white">Aquí puedes ver información de tu cuenta</h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-page">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="inner-content">
            <div class="row">
              <div class="col-lg-6">
                <div id="map">
                  <h1 style="margin-top: 50px; padding-top: 20px; padding-bottom: 20px; padding-left: 20px;">Aquí puede ver información de su cuenta</h1>
                  <p style="padding-left: 20px">Puede consultar su saldo disponible, o recargar su cuenta.</p>
                  <p style="padding-left: 20px">Puede enviar un correo a nuestro equipo para <a href="mailto:mchavarriap628@ulacit.ed.cr">solicitar</a> su tarjeta StarBusk.</p>
                </div>
              </div>
              <div class="col-lg-6 align-self-center">
                
                <form id="contact" action="recarga.html" method="get"> <!--formulario-->
                  <div class="progress" style="margin-top: 30px">
                  <div class="progress-bar bg-success" style="width:100%">  </div>
                </div>

                <div class="row p-3">
                    <div class="col-lg-6" style="margin-top: 15px;">
                      <h1>Saldo disponible:</h1>
                      <p class="btn btn-outline-success" style="margin-top:10px; width: 300px; pointer-events: none;">₡<?php echo $saldoDisponible;?></p>
                    </div>


                    <div class="col-lg-12" style="margin-top: 15px;">
                      <div class="col-lg-12">
                        <a class="btn btn-success col-lg-12" href="recarga.php">Agregar saldo</a>
                      </div>
                      <div class="col-lg-12" style="margin-top: 15px;">
                      <div class="col-lg-12">
                        <a class="btn btn-secondary" href="misPagos.php">Mis pagos</a>
                        <a class="btn btn-secondary" href="misRecargas.php">Mis recargas</a>
                      </div>
                      
                      <a href="assets/php/cerrarSesion.php" class="btn btn-danger" style="margin-top: 100px;">Cerrar sesión</a>
                    </div>

                  </div>
                </form>
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
