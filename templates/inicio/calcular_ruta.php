<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
 <?php include_once 'head_html.php';?>
   <title>Delivery Vargas</title>
</head>
<body class='hide-content'>
    <?php include_once '../loader.php';?>
<div id="contenido">
 <?php include_once 'menu.php';?>
<div  class="container col-md-6">
  <div class="col-md-12">

  <div class="container-form">
  <h4  class="form-solicitud-title"><i class="fa fa-calculator" aria-hidden="true"></i> Calculadora de Ruta</h4>
      <form class="form-calculadora">
        
        <div class="form-group">
          <label for="from" class="col-xs-2 form-label"><i class="fas fa-map-marker-alt"></i> Mi Ubicación: <span class="text-danger">*</span> </label>
          <div class="col-xs-4">
            <input id="from" type="text" placeholder="Punto de Partida" class="input-opcion-3" required>
          </div>
        </div>
        <div class="form-group">
          <label for="to" class="col-xs-2 form-label"><i class="fas fa-map-marker-alt"></i> Destino: <span class="text-danger">*</span></label>
          <div class="col-xs-4">
            <input id="to" type="text" placeholder="Destino" class="input-opcion-3" required>
          </div>
        </div>
        <a id="buscar" tittle="Trazar Ruta" class="btn nav-link"><i class="fas fa-directions fa-2x m-2"></i></a>
        <div class="container-map-form">
        <div id="googleMap">

        </div>
    </div>
    <div id="output">

        </div>

      </form>


        
  </div>
  </div>
  

</div>
</div>

<?php include_once 'scripts.php';?>
<script src="js/mapas/google_map.js"></script>
</body>
</html>