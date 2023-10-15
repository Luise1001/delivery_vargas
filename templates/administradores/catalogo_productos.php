<?php
include_once 'redirect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include_once 'head_html.php'; ?>
   <title>Delivery Vargas</title>
</head>

<body class='hide-content'>
   <?php include_once '../loader.php'; ?>
   <?php include_once '../inicio/menu.php'; ?>

   <div class="principal-layout">
   <div class="container-search">
      <input class="buscador" type="text" placeholder="Buscar Producto">
      <img class="icon-search" src="../../server/images/icons/lupa.png">
    </div>
    <div class="productos"></div>

   </div>

   <script src="js/consulta/catalogo_productos.js"></script>

   <?php include_once 'scripts.php'; ?>

</body>

</html>