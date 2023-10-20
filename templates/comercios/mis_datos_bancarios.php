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
        <div class="type-order-title">Pago Móvil</div>
        <div class='pm'></div>
      </div>
      <div class="slider">
      <div class="type-order-title">Transferencia</div>
        <div class='tr'></div>
      </div>
      <div class="slider">
      <div class="type-order-title">Zelle</div>
        <div class='zl'></div>
      </div>
    </div>
  </div>

  <script src="js/consulta/mis_datos_bancarios.js"></script>

  <?php include_once 'scripts.php'; ?>
</body>

</html>