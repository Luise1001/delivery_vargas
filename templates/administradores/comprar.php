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
      <div id="publicidad" class="carousel slide" data-bs-ride="carousel"></div>
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