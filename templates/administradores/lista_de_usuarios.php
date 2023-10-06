<?php 
include_once 'redirect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<?php include_once 'head_html.php';?>
   <title>Delivery Vargas</title>
</head>
<body class='hide-content'>
    <?php include_once '../loader.php';?>
<div id="contenido" >
  
<?php include_once 'menu.php';?>

    <div class="lista-de-usuarios cuerpo">
      
<ul class="nav nav-tabs cabecera">
<div class="carousel-indicators">
<li class="nav-item">
  <a id="slide_0" href="#" class="headerbar-link"  data-bs-target="#mis_usuarios" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1">Comercios</a>
</li>
<li class="nav-item">
  <a href="#" class="headerbar-link" data-bs-target="#mis_usuarios" data-bs-slide-to="1" aria-label="Slide 2">Clientes</a>
</li>
</div>
</ul>

<div id="mis_usuarios" class="carousel slide">
<div class="carousel-inner">
  <div class="carousel-item active">
    <div id="comercios"></div>
  </div>
  <div class="carousel-item">
    <div id="clientes"></div>
  </div>
</div>
<button class="carousel-control-prev visually-hidden" type="button" data-bs-target="#mis_usuarios" data-bs-slide="prev">
  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next visually-hidden" type="button" data-bs-target="#mis_usuarios" data-bs-slide="next">
  <span class="carousel-control-next-icon" aria-hidden="true"></span>
  <span class="visually-hidden">Next</span>
</button>
</div>

    </div>

 </div>

<script src="js/consulta/lista_de_usuarios.js"></script>

<?php include_once 'scripts.php';?>
</body>
</html>