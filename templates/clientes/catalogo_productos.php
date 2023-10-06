<?php 
 include_once 'redirect.php';

 if($_GET)
 {
    $categoria = $_GET['categoria'];
    $comercio = $_GET['comercio'];
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include_once 'head_html.php';?>
    <title>Delivery Vargas</title>
</head>
<body class='hide-content'>
    <?php include_once '../loader.php';?>
    
   <div id="contenido">
   <?php include_once 'menu.php';?>

   <input type="hidden" id="categoria" value="<?php echo $categoria;?>">
   <input type="hidden" id="comercio" value="<?php echo $comercio;?>">

  <div  class="catalogo-productos cuerpo d-flex flex-wrap">


   </div>
   </div>





  <script src="js/consulta/catalogo_productos.js"></script>

  <?php include_once 'scripts.php';?>
    
</body>
</html>