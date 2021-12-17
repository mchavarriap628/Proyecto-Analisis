<?php
session_start();
error_reporting(0);
//include './assets/php/cn.php';
$loggedUser = $_SESSION['loggedUser'];
$loggedUserID = $_SESSION['loggedUserID'];
$rol = $_SESSION['rol'];
if ($loggedUser == null || $loggedUserID == '' || $rol!='admin') {
  echo "Error de autenticación, por favor inicie sesión.";
  die();
}


?>


<!DOCTYPE html>
<html>

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>StarkBus - Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-plot-listing.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">

    <!--Scripts propios-->
    <script type="text/javascript" src="assets/js/validarInformacionCrearConductor.js"></script>
    <script type="text/javascript" src="assets/js/fuerzaContrasena.js"></script>

    <style>
      select{
        margin-bottom: 10px;
      }
    </style>

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
            <h1  class="p-3 mb-2 bg-info text-white">¡Bienvenido estimado <?php echo $_SESSION['loggedUser'] ?>!</h1>
            <h3  class="p-3 mb-2 bg-info text-white">Gracias por formar parte de la comunidad Starkbus</h3>
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

          <div class="col-lg-6"> <!--Agregar Empleado-->
          <form id="contact" action="assets/php/crearConductorDB.php" method="post" onsubmit="return validar();"> 
            <p class="bg-primary" align="center" style="margin-bottom: 15px; color: white; font-weight: bold;">Agregar un nuevo conductor al sistema</p>
            
            <input id="conductorNombre" type="text" placeholder="Nombre" name="conductorNombre" require="required">
            <input id="conductorCorreo" type="email" placeholder="Correo electrónico" name="conductorCorreo" required="required">
            
            <span id="password_strength">Fuerza de la contraseña...</span>
            <input id="conductorContrasena" type="password" placeholder="Contraseña" name="conductorContrasena" onkeyup="CheckPasswordStrength(this.value)" required="required">
            <input id="conductorContrasenaDos" type="password" placeholder="Contraseña" name="conductorContrasenaDos" required="required">
            
            <input type="submit" name="btnAgregarConductor" value="Agregar Empleado">
          </form>

          <form id="contact" action="assets/php/eliminarConductorDB.php" method="post">
            <p class="bg-primary" align="center" style="margin-bottom: 15px; color: white; font-weight: bold;">Remover un conductor del sistema</p>
            <label for="removerConductorDB">Seleccione un conductor por favor</label>
            <select id="removerConductorDB" class="form-select" name="removerConductorDB" required="required"> <!--conductor a remover-->
              <option value="">-Seleccione-</option>
              <?php
              include 'assets/php/cn.php';
              $sql = "SELECT Nombre from Usuario where Rol='conductor';";
              $conductorArray = sqlsrv_query($conn,$sql);
              while($row = sqlsrv_fetch_array( $conductorArray, SQLSRV_FETCH_ASSOC)):;
              ?>
              <option value="<?php echo $row['Nombre']; ?>"> <?php echo $row['Nombre']; ?> </option>
              <?php endwhile; sqlsrv_free_stmt($conductorArray);?>
            </select>
            <input type="submit" name="btnEliminarConductor" value="Eliminar Empleado">
          </form>
          </div>

          <!--arriba izquierda & abajo derecha-->

          <div class="col-lg-6" > 
          <form id="contact" action="assets/php/crearRutaDB.php" method="post"> <!--Agregar ruta al sistema-->
            <p class="bg-primary" align="center" style="margin-bottom: 15px; color: white; font-weight: bold;">Agregar rutas al sistema</p>
            <input id="nuevaRutaNombre" type="text" placeholder="Nueva Ruta" name="nuevaRutaNombre" required="required">
            <input id="nuevaRutaPrecio" type="number" placeholder="Precio" name="nuevaRutaPrecio" required="required">
            <input type="submit" name="btnAgregarRuta" value="Agregar ruta al sistema">
          </form>

          <form id="contact" action="assets/php/eliminarRutaDB.php" method="post">
          <p class="bg-primary" align="center" style="margin-bottom: 15px; color: white; font-weight: bold;">Remover ruta del sistema</p>
          <label for="removerRutaDB">Seleccione una ruta por favor</label>  
          <select id="removerRutaDB" class="form-select" name="removerRutaDB" required="required"> <!--rutas para remover-->
            <option value="">-Seleccione-</option>
            <?php
              include 'assets/php/cn.php';
              $sql = "SELECT nombre_ruta FROM Rutas";
              $rutasArray = sqlsrv_query($conn,$sql);
              while($row = sqlsrv_fetch_array( $rutasArray, SQLSRV_FETCH_ASSOC)):;
              ?>
              <option value="<?php echo $row['nombre_ruta']; ?>"> <?php echo $row['nombre_ruta']; ?> </option>
              <?php endwhile; sqlsrv_free_stmt($rutasArray);?>
            </select>
            <input type="submit" name="btnEliminarRuta" value="Eliminar Ruta">
          </form>
          </div>

          <!--los dos formularios de abajo -->

          <div class="col-lg-6" >
            <form id="contact" action="assets/php/modificarPrecioRuta.php" method="post"> <!--Modificar precio-->
            <p class="bg-primary" align="center" style="margin-bottom: 15px; color: white; font-weight: bold;">Modificar precio a una ruta</p>
            <label for="rutaModificandoPrecio">Seleccione una ruta para modificar su precio</label>
            <select id="rutaModificandoPrecio" class="form-select" name="rutaModificandoPrecio"  required="required"><!--Rutas para precio-->
              <option value="">-Seleccione-</option>
              <?php
              include 'assets/php/cn.php';
              $sql = "SELECT nombre_ruta FROM Rutas";
              $rutasArray = sqlsrv_query($conn,$sql);
              while($row = sqlsrv_fetch_array( $rutasArray, SQLSRV_FETCH_ASSOC)):;
              ?>
              <option value="<?php echo $row['nombre_ruta']; ?>"> <?php echo $row['nombre_ruta']; ?> </option>
              <?php endwhile; sqlsrv_free_stmt($rutasArray);?>
            </select>
            <input type="number" id="NuevoPrecio" name="NuevoPrecio" placeholder="Nuevo precio en colones" required="required">
            <input type="submit" name="btnEstablecerPrecio" value="Establecer precio a ruta">
          </form>
          </div>

          <div class="col-lg-6" >
            <form id="contact" action="assets/php/asignarRutasDB.php" method="post">
            <p class="bg-primary" align="center" style="margin-bottom: 15px; color: white; font-weight: bold;">Asignar ruta a conductor</p>
            <label for="rutaParaAsignar">Seleccione una ruta</label>
            <select id="rutaParaAsignar" class="form-select" name="rutaParaAsignar" required="required"> <!--rutas para asignar-->
              <option value="">-Seleccione-</option>
              <?php
              include 'assets/php/cn.php';
              $sql = "SELECT nombre_ruta FROM Rutas";
              $rutasArray = sqlsrv_query($conn,$sql);
              while($row = sqlsrv_fetch_array( $rutasArray, SQLSRV_FETCH_ASSOC)):;
              ?>
              <option value="<?php echo $row['nombre_ruta']; ?>"> <?php echo $row['nombre_ruta']; ?> </option>
              <?php endwhile; sqlsrv_free_stmt($rutasArray);?>
            </select>
            <label for="conductorParaAsignar">Seleccione un conductor</label>
            <select id="conductorParaAsignar" class="form-select" name="conductorParaAsignar" required="required"> <!--conductores para asignarles una ruta-->
              <option value="">-Seleccione-</option>
              <?php
              include 'assets/php/cn.php';
              $sql = "SELECT Nombre from Usuario where Rol='conductor';";
              $conductorArray = sqlsrv_query($conn,$sql);
              while($row = sqlsrv_fetch_array( $conductorArray, SQLSRV_FETCH_ASSOC)):;
              ?>
              <option value="<?php echo $row['Nombre']; ?>"> <?php echo $row['Nombre']; ?> </option>
              <?php endwhile; sqlsrv_free_stmt($conductorArray);?>
            </select>
            </select>
            <input type="submit" name="btnEstablecerPrecio" value="Asignar ruta">
          </form>
          </div>


          <!--Botones de cerrar sessión y reportes-->
          <div class="row">
            <div class="col-sm">
              <!--Reportes-->
              <div class="d-grid gap-2" style="margin-bottom: 15px;">
              <a href="#" class="btn btn-warning" type="button">Ver reportes</a>
              </div>
            </div>
            <div class="col-sm">
              <!--Cerrar sesión-->
              <div class="d-grid gap-2">
              <a href="assets/php/cerrarSesion.php" class="btn btn-danger" type="button">Cerrar sesión</a>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
  </div>
</div>


<!--Pie de pagina----------------------------------------------------------------------------------------------------------------------->
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