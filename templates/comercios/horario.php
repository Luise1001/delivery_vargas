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
    <div class="schedule"></div>

   </div>

  <script src="js/consulta/horario.js"></script>
  <script src="js/agregar/agregar_horario.js"></script>
  <script src="js/editar/editar_horario.js"></script>

  <?php include_once 'scripts.php'; ?>
</body>

</html>