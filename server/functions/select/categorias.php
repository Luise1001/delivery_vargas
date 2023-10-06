<?php

function categorias_comercios()
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

if($mis_categorias)
{
  foreach($mis_categorias as $dato)
{
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

   if($lista_de_categorias)
   {
    foreach($lista_de_categorias as $categoria)
    {
      $id = $categoria['Id'];
      $categoria_name = $categoria['Categoria'];
  
      $checked = CheckCategory($id, $id_comercio);
  
      if(!$checked)
      {
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

function comercios_by_categoria()
{
    $categorias = BusinessCategories();

    foreach($categorias as $categoria)
    {
      $id_categoria = $categoria['Id'];
      $titulo = $categoria['Categoria'];
      $comercios = BusinessByCategories($id_categoria);

     if($comercios)
     {
      $lista = 
      "
      <ul>
      <div class='opciones'>
          <a  class='btn menu_opciones categorias-comercios' title='Categorías'>
          <i class='fas fa-tag'></i> $titulo
         </i> <i id='arrow_pd' class='fas fa-angle-down'></i>
          </a>
    <div class='dropdown-container'>
    <li>";
    foreach($comercios as $comercio)
    {
      $id_categoria = $comercio['Id_categoria'];
      $id_comercio = $comercio['Id_comercio'];
      $stock = StockCommerce($id_comercio);

      if($stock)
      {
        $nombre = $comercio['Razon_social'];
         $lista .=
         "
         <p><a id='ver_catalogo' categoria='$id_categoria' comercio='$id_comercio' class='btn'>$nombre</a></p>
         ";
      }
    }
       
      $lista .=
      "  
    </li>
     </div>
    </div>
    </ul>";
  
      echo $lista;
     }
      
    }

}

