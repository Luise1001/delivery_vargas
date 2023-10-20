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
        <div class="type-order-title">Activos</div>
        <div id="pendientes"></div>
      </div>
      <div class="slider">
      <div class="type-order-title">Completados</div>
        <div id="completados"></div>
      </div>
      <div class="slider">
      <div class="type-order-title">Anulados</div>
        <div id="anulados"></div>
      </div>
    </div>
  </div>


  <script src="js/consulta/pedidos.js"></script>

  <?php include_once 'scripts.php'; ?>
</body>

</html>