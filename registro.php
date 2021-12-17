<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>StarkBus - Registro</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-plot-listing.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">

    <!--Scripts propios-->
    <script type="text/javascript" src="assets/js/validarInformacionCrearCuenta.js"></script>
    <script type="text/javascript" src="assets/js/fuerzaContrasena.js"></script>

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
            <h1  class="p-3 mb-2 bg-info text-white">¡Estás a punto de formar parte de nuestra familia!</h1>
            <h3  class="p-3 mb-2 bg-info text-white">Crea tu cuenta gratuitamente</h3>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="inner-content">
        <div class="row" style="padding-top: 50px;">

          <div class="col-lg-12">

            <!-- Insertar datos en base de datos mediante form -->


          <form id="contact" action="assets/php/registroDB.php" method="post" onsubmit="return validarInformacion();" > <!--formulario-->
            <p class="bg-primary" align="center" style="margin-bottom: 15px; color: white; font-weight: bold; border-radius: 10px;">Información personal</p>
            
            <p class="bg-secondary" align="center" style="margin-bottom: 15px; color: white; font-weight: bold; border-radius: 10px;">Por favor ingrese su nombre y apellidos</p>
            <input id="formularioNombre" type="text" placeholder="Nombre" name="Nombre" required="required">
           
            <p class="bg-secondary" align="center" style="margin-bottom: 15px; color: white; font-weight: bold; border-radius: 10px;">Por favor ingrese su correo eléctronico</p>
            <input id="formularioCorreo" type="email" placeholder="Correo electrónico" name="Correo" required="required">
            
            <p class="bg-secondary" align="center" style="margin-bottom: 15px; color: white; font-weight: bold; border-radius: 10px;">Por favor ingrese una contraseña</p>
            <span id="password_strength">Fuerza de la contraseña...</span> <!--Fuerza de la contraseña-->
            <input id="formularioContrasena" type="password" placeholder="Contraseña" name="Password" onkeyup="CheckPasswordStrength(this.value)" required="required" minlength="8">
            
            <p class="bg-secondary" align="center" style="margin-bottom: 15px; color: white; font-weight: bold; border-radius: 10px;">Por favor vuelva a ingresar la contraseña</p>
            <input id="formularioContrasenaConfirma" type="password" placeholder="Retipa la contraseña" name="PasswordVer" required="required" minlength="8">
            
            <input type="submit" name="btnCrearCuenta" value="Crear Cuenta">
            
            
            <div class="col-lg-12" style="margin-top: 15px;">
            <a href="login.html" class="btn btn-danger">Regresar</a>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>



  <footer>
    <div class="container">
        <div class="col-lg-12">
          <div class="sub-footer">
            <a id="volverInicio" href="login.html">Haga click <u>aquí</u> para volver.</a>
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