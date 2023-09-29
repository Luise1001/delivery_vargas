<?php 
include_once 'verificar_sesion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<?php include_once 'head_html.php';?>
   <title>Delivery Vargas</title>
</head>
<body class='hide-content'>
    <?php include_once 'loader.php';?>
<div id="contenido" >
 
<?php include_once 'sidebar.php';?>



<div class="lista-de-envios cuerpo">

<ul class="nav nav-tabs cabecera">
<div class="carousel-indicators">
<li class="nav-item">
  <a id="slide_0" href="#" class="headerbar-link"  data-bs-target="#mis_envios" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1">Pendientes</a>
</li>
<li class="nav-item">
  <a href="#" class="headerbar-link" data-bs-target="#mis_envios" data-bs-slide-to="1" aria-label="Slide 2">Tránsito</a>
</li>
<li class="nav-item">
  <a href="#" class="headerbar-link" data-bs-target="#mis_envios" data-bs-slide-to="2" aria-label="Slide 3">Completados</a>
</li>
</div>
</ul>

<div id="mis_envios" class="carousel slide">
<div class="carousel-inner">
  <div class="carousel-item active">
    <div id="pendientes"></div>
  </div>
  <div class="carousel-item">
    <div id="transito"></div>
  </div>
  <div class="carousel-item">
    <div id="completados"></div>
  </div>
</div>
<button class="carousel-control-prev visually-hidden" type="button" data-bs-target="#mis_envios" data-bs-slide="prev">
  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next visually-hidden" type="button" data-bs-target="#mis_envios" data-bs-slide="next">
  <span class="carousel-control-next-icon" aria-hidden="true"></span>
  <span class="visually-hidden">Next</span>
</button>
</div>

</div>

<script src="js/consulta/lista_de_envios.js"></script>

<?php include_once 'scripts.php';?>
<?php include_once 'footer.php';?>
</body>
</html>