<?php 
 include_once 'verificar_sesion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include_once 'head_html.php';?>
    <title>Delivery Vargas</title>
</head>
<body class='hide-content'>
    <?php include_once 'loader.php';?>
     <div id="contenido">
     <?php include_once 'sidebar.php';?>

     <div class="user-head text-center"></div>

     <div id="my_profile" class="user-personal-data cuerpo"></div>

     <div id="configuracion" class="user-setting cuerpo"></div>
     
    </div>

  <script src="js/consulta/perfil.js"></script>

  <?php include_once 'scripts.php';?>
  
  <?php include_once 'footer.php';?>
    
</body>
</html>