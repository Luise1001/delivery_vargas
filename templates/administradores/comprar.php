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
      <input id='buscador' class="buscador" type="text" placeholder="Buscar Producto">
      <img class="icon-search" src="../../server/images/icons/lupa.png">
    </div>

    <div class="search-result"></div>

    <div class="advertisements">
      <div id="publicidad" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#publicidad" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#publicidad" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#publicidad" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="img-ads" src="../../server/images/ads/option_1.jpg" alt="promotion">
          </div>
          <div class="carousel-item">
            <img class="img-ads" src="../../server/images/ads/option_2.jpg" alt="promotion">
          </div>
          <div class="carousel-item">
            <img class="img-ads" src="../../server/images/ads/option_3.jpg" alt="promotion">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#publicidad" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#publicidad" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <div class="container container-categories">
      <h4 class="titulo-categorias">Categorías</h4>
      <div class="categories"></div>
    </div>
    <div class="container container-products">
      <h4 class='titulo-categorias'>Nuevos Productos</h4>
      <div class="new-products"></div>
    </div>
  </div>
  <script src="js/consulta/comprar.js"></script>

  <?php include_once 'scripts.php'; ?>

</body>

</html>