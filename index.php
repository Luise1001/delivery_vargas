<?php
 include_once 'server/conexion.php';
 if(isset($_SESSION['DLV']))
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
<link rel="shortcut icon" href="server/images/icons/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/tags.css">
<link rel="stylesheet" href="css/modals.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
<link rel="apple-touch-icon" href="server/images/icons/apple-touch-icon.png"> 
<link rel="apple-touch-icon-precomposed" href="server/images/icons/apple-touch-icon.png"> 
<link rel="apple-touch-icon-precomposed apple-touch-icon" href="server/imagns/icons/apple-touch-icon.png">

<script src="js/install.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
    <title>Delivery Vargas</title>
</head>
<body class='hide-content'>
  <?php include_once 'templates/loader.php';?>
<div class="container container-index">
  <div id="card_sesion" class="card card-sesion">
  <img  src="server/images/logos/deliveryvargas.png" class="brand-login"  alt="logo">
  <div>
    <p class="form-label">Iniciar Sesión</p>
  </div>
  <form method='POST' class='form-index'>
    <div class="col-md-12 form-index-child">
        <input class="input-opcion-6" type="email" id="user" name="user" placeholder="E-mail"  required>
    </div>

    <div class="col-md-12 form-index-child">
        <input class="input-opcion-6" type="password" id="password" name="password" placeholder="Contraseña"  required>
    </div>

    <div class="col-md-12 form-index-child">
        <button id="log_in" name="log_in"  class="card-btn m-2"><i class="fas fa-sign-in-alt fa-2x m-2"></i></button>
    </div>

    <div class="col-md-12 form-index-child">
        <a class="sidebar-link reset-pass form-label" data-toggle="modal" data-target="#reset_password">Recuperar Contraseña</a>
    </div>

    <div class="col-md-12 form-index-child">
      <button id="installButton" hidden  class="card-btn">Instalar App</button>
    </div>
  </form>

  <div class="col-md-12 form-index-child">
    <a id="sing_up_option"  class="card-link form-label">Registrarse</a>
  </div>
</div>

<div id="card_registrarse" class="card card-sesion">
<img src="server/images/logos/deliveryvargas.png" class="brand-login"  alt="logo">
  <div>
    <p class="form-label">Registrarse</p>
  </div>
<form class='form-index'>
    <div class="col-md-12 form-index-child">
        <input class="input-opcion-6" type="email" id="r_user_name" name="r_user_name" placeholder="E-mail"  required>
    </div>

    <div class="col-md-12 form-index-child">
        <input class="input-opcion-6" type="password" id="r_password" name="r_password" placeholder="Contraseña"  required>
    </div>

    <div class="col-md-12 form-index-child">
        <input class="input-opcion-6" type="password" id="r_password_2" name="r_password_2" placeholder="Repetir Contraseña"  required>
    </div>

    <div class="col-md-12 form-index-child">
    <div id="alert" class="text-danger"></div>
    </div>

    <div class="col-md-12 form-index-child">
        <button type="button" id="sent_code"  data-toggle="modal" data-target="#verify_email"  class="card-btn m-2">
          <i class="fas fa-sign-in-alt fa-2x m-2"></i>
        </button>
    </div>
    <div class="col-md-12 form-index-child">
    <span class='span-option-1'>Al Continuar Acepta Nuestros <a href="#" data-toggle="modal" data-target="#politicas">Términos y Condiciones</a></span>
    </div>
</form>
  <div class="form-index-child">
    <a id="log_in_option"  class="card-link form-label">Iniciar Sesión</a>
  </div>
</div>

</div>

<?php include_once 'templates/modals.php';?>
<div class="div-water-mark">
  <img class='water-mark' src="server/images/logos/suarezresuelve.png" alt="water-mark">
</div>

<script src="js/loader.js"></script>
<script src="js/index.js"></script>
</body>
</html>