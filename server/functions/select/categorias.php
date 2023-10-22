<?php

function SliderAds()
{
  $respuesta = 
  "
          <div class='carousel-indicators'>
          <button type='button' data-bs-target='#publicidad' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide 1'></button>
          <button type='button' data-bs-target='#publicidad' data-bs-slide-to='1' aria-label='Slide 2'></button>
          <button type='button' data-bs-target='#publicidad' data-bs-slide-to='2' aria-label='Slide 3'></button>
          <button type='button' data-bs-target='#publicidad' data-bs-slide-to='3' aria-label='Slide 4'></button>
        </div>
        <div class='carousel-inner'>
          <div class='carousel-item active'>
            <img class='img-ads' src='../../server/images/ads/option_1.png' alt='promotion'>
          </div>
          <div class='carousel-item'>
            <img class='img-ads' src='../../server/images/ads/option_2.png' alt='promotion'>
          </div>
          <div class='carousel-item'>
            <img class='img-ads' src='../../server/images/ads/option_3.png' alt='promotion'>
          </div>
          <div class='carousel-item'>
            <img class='img-ads' src='../../server/images/ads/option_4.png' alt='promotion'>
          </div>
        </div>
        <button class='carousel-control-prev' type='button' data-bs-target='#publicidad' data-bs-slide='prev'>
          <span class='carousel-control-prev-icon' aria-hidden='true'></span>
          <span class='visually-hidden'>Previous</span>
        </button>
        <button class='carousel-control-next' type='button' data-bs-target='#publicidad' data-bs-slide='next'>
          <span class='carousel-control-next-icon' aria-hidden='true'></span>
          <span class='visually-hidden'>Next</span>
        </button>
      </div>
  ";

  echo $respuesta;
}

function categorias()
{
  include_once '../conexion.php';

  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $respuesta =
    [
      'titulo' => 'COMPRAR',
      'categorias' => '',
    ];
  $BusinessCategories = BusinessCategories();

  if ($BusinessCategories) {
    foreach ($BusinessCategories as $category) {
      $id = $category['Id'];
      $categoria = $category['Categoria'];
      $icon = $categoria . '_On.png';

      $respuesta['categorias'] .=
        "
       <div class='category-item'>
         <a href='categoria?id=$id&categoria=$categoria'><img class='category-icon' 
         src='../../server/images/icons/categorias/$icon' alt='$categoria'></a>
         <span class='category-span'>$categoria</span>
       </div>
       ";
    }
  } else {
    $respuesta['categorias'] = EmptyPage('Sin Categorías');
  }

  echo json_encode($respuesta);
}

function productos_nuevos()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $respuesta =
    [
      'productos' => '',
    ];
  $NewProducts = NewProducts();

  if ($NewProducts) {
    foreach ($NewProducts as $product) {
      $id_comercio = $product['comercio'];
      $descripcion = $product['descripcion'];
      $codigo = $product['codigo'];
      $precio = $product['precio'];
      $foto = SearchProductPhoto($id_comercio, $codigo);

      $respuesta['productos'] .=
        "
      <div class='item-grid'>
      <div class='img-grid'>
      <img class='img-product' src='$foto' class='card-img-top' alt='Nuevo Producto'>
      </div>
      <div class='item-grid-body'>
        <h5 class='item-grid-title'>$descripcion</h5>
        <p class='item-grid-text'>$$precio</p>
      </div>
      <div class='button-grid'>
      <a href='catalogo_productos?comercio=$id_comercio' class='show-more-products'>Ver Más</a>
      </div>
    </div>
      ";
    }
  } else {
    $respuesta['productos'] = EmptyPage('Sin Productos Disponibles');
  }

  echo json_encode($respuesta);
}


function mis_categorias()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $ComercioData = ComercioData($UserID);
  $id_comercio = $ComercioData[0]['Id'];
  $OptionsCategories = OptionsCategories($id_comercio);
  $BusinessCategories = BusinessCategories();
  $categorias = '';

  if ($OptionsCategories) {
    foreach ($OptionsCategories as $category) {
      $id = $category['Id'];
      $category_name = $category['Categoria'];

      $categorias .=
      "
       <div class='form-check form-switch form-check-reverse switch-container'>
          <div class='cat-text-switch'>
           $category_name
           </div>
           <div class='cat-input-switch'>
           <input class='form-check-input select-cat-comer' type='checkbox' role='switch' checked  value='$category_name' id='$category_name' name='$id'>
           <label class='form-check-label' for='$id'></label> 
         </div>
       </div>
      ";
    }
  }

  if ($BusinessCategories) {
    foreach ($BusinessCategories as $categoria) {
      $id = $categoria['Id'];
      $category_name = $categoria['Categoria'];

      $CheckCategory = CheckCategory($id, $id_comercio);

      if (!$CheckCategory) {
        $categorias .=
        "
          <div class='form-check form-switch form-check-reverse switch-container'>
            <div class='cat-text-switch'>
              $category_name
            </div>
            <div class='cat-input-switch'>
            <input class='form-check-input select-cat-comer' type='checkbox' role='switch'  value='$category_name' id='$category_name' name='$id'>
            <label class='form-check-label' for='$id'></label> 
            </div>
         </div>
        ";
      }
    }
  }

  echo $categorias;
}
