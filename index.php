<?php
 include_once 'functions/conexion.php';
 if(isset($_SESSION['admin']))
 {
  echo"<script type='text/javascript'>
  window.location.href='templates/inicio/inicio';
  </script>";
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">

<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<meta name="apple-mobile-web-app-title" content="Delivery Vargas">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="theme-color" content="#fce944"/>

<link rel="manifest" href="manifest.json" />
<script src="js/install.js"></script>
<link rel="shortcut icon" href="img/arts/icons_01/logos/favicon.ico" type="image/x-icon">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

<link rel="stylesheet" href="templates/css/style.css">
<link rel="stylesheet" href="templates/css/modals.css">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
<link href='https://fonts.googleapis.com/css?family=Fauna One' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Josefin Slab' rel='stylesheet'>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="apple-touch-icon" href="../img/arts/icons_01/logos/apple-touch-icon.png"> 
<link rel="apple-touch-icon-precomposed" href="../img/arts/icons_01/logos/apple-touch-icon.png"> 
<link rel="apple-touch-icon-precomposed apple-touch-icon" href="../img/arts/icons_01/logos/apple-touch-icon.png">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Delivery Vargas</title>
</head>
<body class='hide-content'>
  <?php include_once 'templates/loader.php';?>
<div class="container container-index">
  <div id="card_sesion" class="card">
  <img src="img/arts/deliveryvargaslogo.png" class="card-img"  alt="logo">
  <div>
    <p class="form-label">Iniciar Sesión</p>
  </div>
  <form id="formSesion">
  <ul class="ul-index">
    <div class="col-md-12 card-div ">
        <input class="input-opcion-6" type="email" id="user_name" name="user_name" placeholder="E-mail"  required>
    </div>

    <div class="col-md-12 card-div ">
        <input class="input-opcion-6" type="password" id="password" name="password" placeholder="Contraseña"  required>
    </div>

    <div class="col-md-12 card-div">
      <button id="installButton" hidden class="card-btn">Instalar App</button>
    </div>

    <div class="col-md-12 card-div">
        <button id="log_in" name="log_in"  class="card-btn m-2"><i class="fas fa-sign-in-alt fa-2x m-2"></i></button>
    </div>

    <div class="col-md-12 card-div">
        <a class="sidebar-link reset-pass form-label" data-toggle="modal" data-target="#reset_password">Recuperar Contraseña</a>
    </div>
  </ul>
  </form>

  <div class="card-body footer-card-body">
    <a id="sing_up_option"  class="card-link form-label">Registrarse</a>
    <a id="admin_option"  class="card-link form-label">Soy Administrador</a>
  </div>
</div>

<div id="card_registrarse" class="card">
<img src="img/arts/deliveryvargaslogo.png" class="card-img"  alt="logo">
  <div>
    <p class="form-label">Registrarse</p>
  </div>
<form id="FormSingUp">
<ul class="ul-index">
    <div class="col-md-12 card-div">
        <input class="input-opcion-6" type="email" id="r_user_name" name="r_user_name" placeholder="E-mail"  required>
    </div>

    <div class="col-md-12 card-div">
        <input class="input-opcion-6" type="password" id="r_password" name="r_password" placeholder="Contraseña"  required>
    </div>

    <div class="col-md-12 card-div">
        <input class="input-opcion-6" type="password" id="r_password_2" name="r_password_2" placeholder="Repetir Contraseña"  required>
        <div id="alert" class="text-danger"></div>
    </div>

    <div class="col-md-12 card-div">
        <button type="button" id="sent_code"  data-toggle="modal" data-target="#verify_email"  class="card-btn m-2"><i class="fas fa-sign-in-alt fa-2x m-2"></i></button>
        <p style="font-size: small;">Al Continuar Acepta Nuestros <a href="#" data-toggle="modal" data-target="#politicas">Términos y Condiciones</a></p>
      </div>
  </ul>
</form>
  <div class="card-body footer-card-body">
    <a id="log_in_option"  class="card-link form-label">Iniciar Sesión</a>
    <a id="admin_option"  class="card-link form-label">Soy Administrador</a>
  </div>
</div>

<div id="card_admin" class="card">
<img src="img/arts/deliveryvargaslogo.png" class="card-img"  alt="logo">
  <div>
    <p class="form-label">Administrador</p>
  </div>
   <form id="SesionAdmin">
   <ul class="ul-index">
    <div class="col-md-12 card-div">
        <input class="input-opcion-6" type="email" id="a_user_name" name="a_user_name" placeholder="E-mail"  required>
    </div>

    <div class="col-md-12 card-div">
        <input class="input-opcion-6" type="password" id="a_password" name="a_password" placeholder="Contraseña" required>
    </div>

    <div class="col-md-12 card-div">
        <button id="login" name="login" class="card-btn m-2"><i class="fas fa-sign-in-alt fa-2x m-2"></i></button>
    </div>

    <div class="col-md-12 card-div text-center">
        <a class="sidebar-link reset-pass form-label" data-toggle="modal" data-target="#reset_password">Recuperar Contraseña</a>
    </div>

  </ul>
   </form>
  <div class="card-body footer-card-body">
    <a id="log_in_option"  class="card-link form-label">Soy Cliente</a>
    <a id="admin_option"  class="card-link form-label">Soy Administrador</a>
  </div>
</div>

</div>

<?php include_once 'templates/modals.php';?>
<div class="water-mark">
  <img id="water-mark-img" src="img/arts/suarezresuelve1090x490.png" alt="water-mark">
</div>

<script src="js/loader.js"></script>
<script src="js/index.js"></script>
</body>
</html>