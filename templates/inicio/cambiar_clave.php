<?php include_once 'redirect.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'head_html.php';?>
    <title>Delivery Vargas</title>
</head>
<body class='hide-content'>
    <?php include_once '../loader.php';?>
    <?php include_once 'menu.php';?>

    <div class="principal-layout">
    <div class='password-form'>
      <label class='form-label' for='old_pass'>Clave Actual<span class="text-danger">*</span></label>
      <input class='form-control' type='password' id='old_pass' name='old_pass'>
      <label class='form-label' for='new_pass'>Clave Nueva<span class="text-danger">*</span></label>
      <input class='form-control' type='password' id='new_pass' name='new_pass'>
      <label class='form-label' for='repeat_pass'>Repetir Clave Nueva<span class="text-danger">*</span></label>
      <input class='form-control' type='password' id='repeat_pass' name='repeat_pass'>
      <p id="repeat_pass_alert" class="text-danger"></p>
     
      <div class='container'>
        <button id='modificar_clave' class='modificar-clave'>Guardar</button>
      </div>
    </div>
    </div>


    <!-- Para Evitar Errores Con el Mapa -->
        <div hidden id="googleMap">
            <input hidden id='from' type="text">
        </div>
    <!-- Para Evitar Errores Con el Mapa -->

    <script src="js/consulta/cambio_clave.js"></script>
   <?php include_once 'scripts.php';?>

</body>
</html>