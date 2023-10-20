<?php

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
      $icon = $categoria.'_On.png';

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
    'productos'=>'',
  ];
  $NewProducts = NewProducts();

  if($NewProducts)
  {
    foreach($NewProducts as $product)
    {
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
  }
  else
  {
     $respuesta['productos'] = EmptyPage('Sin Productos Disponibles');
  }
 
  echo json_encode($respuesta);
}


function mis_categorias()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $id_usuario = UserID($admin);
  $rif_comercio = ComercioRif($id_usuario);
  $id_comercio = ComercioID($rif_comercio);
  $mis_categorias = OptionsCategories($id_comercio);

  $categorias =
    "
  <ul>
  <div class='opciones'>
      <a  class='btn menu_opciones list-cat-btn' title='Mis Categorías'>
      <i class='fas fa-tags'></i> Mis Categorías
     </i> <i id='arrow_cat' class='fas fa-angle-down'></i>
      </a>
<div class='dropdown-container'>

";

  if ($mis_categorias) {
    foreach ($mis_categorias as $dato) {
      $id = $dato['Id'];
      $categoria_name = $dato['Categoria'];

      $categorias .=
        "
  <li class='form-check form-switch form-check-reverse'>
  <div class='text-switch'>
   $categoria_name
   </div>
   <input class='form-check-input select-cat-comer' type='checkbox' role='switch' checked  value='$categoria_name' id='$categoria_name' name='$id'>
   <label class='form-check-label' for='$id'></label> 
   </li>
  ";
    }
  }

  $lista_de_categorias = BusinessCategories();

  if ($lista_de_categorias) {
    foreach ($lista_de_categorias as $categoria) {
      $id = $categoria['Id'];
      $categoria_name = $categoria['Categoria'];

      $checked = CheckCategory($id, $id_comercio);

      if (!$checked) {
        $categorias .=
          "
        <li class='form-check form-switch form-check-reverse'>
        <div class='text-switch'>
        $categoria_name
        </div>
         <input class='form-check-input select-cat-comer' type='checkbox' role='switch'  value='$categoria_name' id='$categoria_name' name='$id'>
         <label class='form-check-label' for='$id'></label> 
         </li>
        ";
      }
    }
  }

  $categorias .=
    "  
  </div>
  </div>
  </ul>
  ";

  echo $categorias;
}

