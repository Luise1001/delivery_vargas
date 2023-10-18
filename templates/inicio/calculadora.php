<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php include_once 'head_html.php'; ?>
  <title>Delivery Vargas</title>
</head>

<body class='hide-content'>
  <?php include_once '../loader.php'; ?>
  <?php include_once 'menu.php'; ?>

  <div class="principal-layout">
    <div class="calculadora-form">
      <label class='form-label' for="tipo_servicio">Tipo de Servicio</label>
      <div class='input-group'>
        <select class='form-select calculator-select' id='tipo_servicio' name='tipo_servicio'>
          <option value='1'>Delivery</option>
        </select>
      </div>
      <label class='form-label' for='from'>Punto de Partida</label>
      <input class='form-control calculator-input' type='text' id='from' name='from'>
      <label class='form-label' for='to'>Destino</label>
      <input class='form-control calculator-input' type='text' id='to' name='to'>

      <div class="calcular-buttons">
        <button id='calcular' class='calcular'>Calcular</button>
      </div>


      <div class="calculator-map">
        <div id="googleMap"></div>
      </div>

      <div id="output">
        <label class='form-label' for="salida">Punto de Partida:</label>
        <div class='output' id="salida"></div>
        <label class='form-label' for="destino">Destino:</label>
        <div class='output' id="destino"></div>
        <label class='form-label' for="distancia">Distancia:</label>
        <div class='output' id="distancia"></div>
        <label class='form-label' for="tiempo">Tiempo:</label>
        <div class='output' id="tiempo"></div>
        <label class='form-label' for="tarifa">Total a Pagar:</label>
        <div class='output' id="tarifa"></div>
      </div>

    </div>





    <?php include_once 'scripts.php'; ?>
    <script src="js/mapas/calculadora.js"></script>
</body>

</html>