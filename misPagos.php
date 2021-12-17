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
if ($loggedUser == null || $loggedUserID == '' || $rol!='cliente' ) {
  echo "Error de autenticación, por favor inicie sesión.";
  die();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>Mis Pagos</title>

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


    <div class="contact-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div id="map">
                                    <h1
                                        style="margin-top: 50px; padding-top: 20px; padding-bottom: 20px; padding-left: 20px;">
                                        Mis pagos.</h1>
                                    <p style="padding-left: 20px">Aquí puedes ver un historial de todos tus pagos.</p>
                                </div>
                            </div>
                            <div class="col-lg-12 align-self-center">


                                    <!--Barra Azul-->
                                    <div class="progress" style="margin-top: 30px">
                                        <div class="progress-bar bg-info" style="width:100%"> </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12" style="margin-top: 15px;">
                                        <P style="padding-left: 30px; margin-bottom: 15px; border-bottom: 1px solid black;">CORREO -- MONTO -- FECHA -- RUTA</P>
                                        <?php
                                        include 'assets/php/cn.php';
                                        $sql = "SELECT * FROM Pagos WHERE correo='$loggedEmail'";
                                        $conductorArray = sqlsrv_query($conn,$sql);
                                        while($row = sqlsrv_fetch_array( $conductorArray, SQLSRV_FETCH_ASSOC)):;
                                        ?>
                                        <p style="padding-left: 30px;"><?php echo $row['correo']," -- ₡",$row['monto']," -- ",$row['fecha']," -- ",$row['ruta'] ; ?></p>
                                        <?php endwhile; sqlsrv_free_stmt($conductorArray);?>
                                        </div>

                                        <!--Botón Regresar-->
                                        <div class="col-lg-12" style="margin-top: 15px; margin-left: 30px; ">
                                            <a href="cliente.php" class="btn btn-danger">Regresar</a>
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