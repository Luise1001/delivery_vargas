<?php
include_once 'redirect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <?php include_once 'head_html.php'; ?>
  <title>Delivery Vargas</title>
</head>

<body class='hide-content'>
  <?php include_once '../loader.php'; ?>
  <?php include_once '../inicio/menu.php'; ?>
  <div class="principal-layout">
    <div class="wrapper">
      <div class="slider">
        <div class="type-order-title">Clientes</div>
        <div id="clientes"></div>
      </div>
      <div class="slider">
        <div class="type-order-title">Comercios</div>
        <div id="comercios"></div>
      </div>
    </div>
  </div>

  <?php include_once 'modals/editar/modal_convertir_usuarios.php'; ?>
  <script src="js/consulta/lista_de_usuarios.js"></script>

  <?php include_once 'scripts.php'; ?>
</body>

</html>