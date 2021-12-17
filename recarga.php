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
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>StarkBus  - Recarga</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-plot-listing.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">

  </head>

<body class="container-fluid" style="background-color: #f7f7f7;">

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


  <div class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="top-text header-text">
            <h1  class="p-3 mb-2 bg-info text-white">¡Bienvenido estimado <?php echo $_SESSION['loggedUser'] ?>!</h1>
            <h3  class="p-3 mb-2 bg-info text-white">Aquí puedes hacer tus recargas</h3>
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
                <form action="assets/php/recargaDB.php" method="POST"> <!--Inicio del form-->
                  <div class="form-container">
                    <div class="personal-information">
                      <h1 class="p-2">Información de recarga</h1>
                    </div > <!-- end of personal-information -->
                        
                        <!--Nombre-->
                        <label for="first-name" style="margin-top: 15px;">Nombre del dueño de la tarjeta</label><br>
                        <input id="input-field" type="text" name="first-name" placeholder="Nombre" required="required" value="<?php echo $loggedUser;?>"/>
                        <!--Número de tarjeta-->
                        <input id="input-field" type="text" name="number" placeholder="Número de tarjeta" required="required"/>
                        <!--Mes y Año-->
                        <input id="column-left" type="text" name="expiry" placeholder="MM / AAAA" required="required"/>
                        <!--CCV-->
                        <input id="column-right" type="text" name="cvc" placeholder="CCV" required="required"/>
                        <!--Tarjeta-->
                        <div class="card-wrapper"></div>
                        <!--Monto-->
                        <label for="monto" style="margin-top: 15px;">Monto a recargar ₡</label><br>
                        <input id="input-field" type="number" name="monto" required="required" placeholder="0000" required="required" class="col-lg-12"/>
                        <!--Correo-->
                        <label for="email" style="margin-top: 15px;">Correo del destinatario de la recarga</label><br>
                        <input id="input-field" type="email" name="email" required="required" placeholder="Correo electrónico" required="required" value="<?php echo $loggedEmail;?>"/>
                        <!--Submit-->
                        <input id="input-button" type="submit" value="Confirmar recarga" style="border-radius: 15px; margin-top: 15px;"/><br>    

                  </div>
                </form>


                <div>
                  <p style="font-weight: bold; color: red;">Asegurese de que el correo electrónico sea el suyo o el de la persona que recibe la recarga.</p>
                  <a href="cliente.php" class="btn btn-danger" style="margin-top: 20px;">Regresar</a>
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
  <script src="assets/js/Saldo.js"></script> 

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/121761/card.js'></script>
  <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/121761/jquery.card.js'></script><script  src="./assets/js/script.js"></script>

</body>


</html>
