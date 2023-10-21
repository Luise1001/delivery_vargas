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
        <div class="delivery-title">Activos</div>
        <div id="pendientes"></div>
      </div>
      <div class="slider">
        <div class="delivery-title">Asignados</div>
        <div id="asignados"></div>
      </div>
      <div class="slider">
        <div class="delivery-title">Transito</div>
        <div id="transito"></div>
      </div>
      <div class="slider">
        <div class="delivery-title">Completados</div>
        <div id="completados"></div>
      </div>

    </div>
  </div>
  <?php include_once 'modals/consulta/modal_asignar_conductor.php' ?>
  <script src="js/consulta/lista_de_envios.js"></script>

  <?php include_once 'scripts.php'; ?>
</body>

</html>