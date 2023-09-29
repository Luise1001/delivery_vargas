<?php

function catalogo_productos()
{ 
    $id_categoria = $_POST['id_categoria'];
    $id_comercio = $_POST['id_comercio'];
    $comercioData = ComercioData($id_comercio);
    $id_user_comercio = $comercioData[0]['Id_usuario'];
    $rif_comercio = ComercioRif($id_user_comercio);
    $ruta = "../../img/$rif_comercio/productos/";

    $productos = ShowProducts($id_comercio);

    if($productos)
    {
        foreach($productos as $producto)
        {
            $id_producto = $producto['Id_producto'];
            $descripcion = $producto['Descripcion'];
            $movimiento = $producto['U_movimiento'];
            $foto = $producto['Foto'];
            $codigo = $producto['Codigo'];
            $existencia = $producto['Existencia'];
            $precio = $producto['P_civa'];
            $bg_color = ProcessBadge($existencia);
            $producto_enjson = json_encode($producto);

            echo 
            "
            <div class='card card-producto col-6 col-md-2'>
               <div>
               <img src='$ruta$foto.jpg' class='card-img-top foto-producto-catalogo ver_producto' alt='$foto' producto='$id_producto' 
               usuariocomercio='$id_user_comercio' data-toggle='modal' data-target='#full_descripcion'>
               </div>
               <div class='card-body cuerpo-producto'>
               <h7 class='card-title titulo-producto'>$descripcion</h7>
              <p class='card-text'>Stock: $existencia</p>
              <p class='card-text'>Precio: $.$precio</p>

              <button id='add_to_car_$codigo' codigo='$codigo' producto='$id_producto' comercio='$id_comercio' class='btn btn-primary add-to-car-button'>Agregar</button>

              <div id='plus_less_$codigo' codigo='$codigo' hidden class='text-center mt-2'>
              <button id='less_$codigo' codigo='$codigo' producto='$id_producto' comercio='$id_comercio' class='btn btn-primary less-button'>-</button>
              <span id='span_quantity_$codigo' class='btn btn-primary span-quantity'>1</span>
              <button id='plus_$codigo' codigo='$codigo' producto='$id_producto' comercio='$id_comercio' class='btn btn-primary plus-button'>+</button>
              </div>

              </div>
             </div>
            ";
        }
    }
    else
    {
        echo EmptyPage('Sin Productos Disponibles.');
    }
}

function mis_productos()
{
  include_once 'conexion.php';
  $id_usuario = UserID($_SESSION['admin']);
  $rif_comercio = ComercioRif($id_usuario);
  $id_comercio = ComercioID($rif_comercio);
  $boton = 
  '
    <a class="nav-link" data-toggle="modal" data-target="#nuevo_producto" title="Agregar un Nuevo Producto">
     <i class="fas fa-plus-circle"></i> 
    </a>
  ';
  $mis_productos =
  [
    'botones'=> $boton,
    'productos'=> ''
  ];

  $lista_de_productos = MyProductsCommerce($id_comercio);

  if($lista_de_productos)
  {
    foreach($lista_de_productos as $producto)
    {
      $product= json_encode($producto);
      $id_producto = $producto['Id'];
      $existencia = StockProducts($id_producto);
      $calificacion = Rating($id_producto);
      $bg_color = ProcessBadge($existencia);
      $descripcion = $producto['Descripcion'];
      $foto = $producto['Foto'];
      $precio = $producto['P_civa'];
      $codigo = $producto['Codigo'];
      $movimiento = $producto['U_movimiento'];
      $ruta = "../../img/$rif_comercio/productos/";
      

      $mis_productos['productos'] .=
      "
      <div class='card card-producto col-6 col-md-2'>
         <div>
         <img src='$ruta$foto.jpg' class='card-img-top foto-producto-catalogo ver_producto' alt='$foto' producto='$id_producto' 
         usuariocomercio='$id_usuario' data-toggle='modal' data-target='#full_descripcion'>
         </div>
         <div class='card-body cuerpo-producto'>
         <h7 class='card-title titulo-producto'>$descripcion</h7>
        <p class='card-text'>Stock: <span class='badge $bg_color'>$existencia</span></p>
        <p class='card-text'>Precio: $.$precio</p>

        <div class='container col-12'>
        <a producto='$id_producto' comercio='$rif_comercio' codigo='$codigo' class='btn eliminar-producto' id='delete_$id_producto'>
        <i class='fas fa-trash-alt text-danger'></i>
        </a>

        <a class='btn' id='edit_producto_btn'
        producto='$product' existencia='$existencia' comercio='$rif_comercio'  data-toggle='modal' data-target='#editar_producto'>
        <i class='fas fa-edit'></i>
        </a>
        </div>



        </div>
       </div>
      ";
    }

    echo json_encode($mis_productos);
  }
  else
  {
    $mis_productos['productos'] = EmptyPage('Sin Productos Por El Momento.');
    echo json_encode($mis_productos);
  }


}

function full_descripcion()
{
  include_once 'conexion.php';
  $id_usuario = $_POST['id_usuario_comercio'];
  $rif_comercio = ComercioRif($id_usuario);
  $id_comercio = ComercioID($rif_comercio);
  $id_producto = $_POST['id_producto'];
  $existencia = StockProducts($id_producto);
  
  $producto = ShowProduct($id_producto);

  if($producto)
  {
    foreach($producto as $dato)
    {
      $codigo = $dato['Codigo'];
      $descripcion = $dato['Descripcion'];
      $foto = $dato['Foto'];
      $p_siva = $dato['P_siva'];
      $p_civa = $dato['P_civa'];
      $alicuota = $dato['Alicuota'];
      $peso = $dato['Peso'];
      $fecha = $dato['U_movimiento'];
      $fecha = DateFormat($fecha);
      $unit = ProcessWeight($peso);
      $movimiento = $dato['U_movimiento'];
  
      echo 
      "
      <div class='col-md-12'>
        <div id='div_foto_producto'>
        <label class='card-img label-foto' for='foto_producto'><img id='foto' src='../../img/$rif_comercio/productos/$foto.jpg' class='card-img img-foto' alt='Subir Imagen'></label>
      <div>
  
      <div>
      <li class='list-group-item descripcion-ampliada'>Descripción: $descripcion</li>
      <li class='list-group-item'>Precio sin iva: $.$p_siva</li>
      <li class='list-group-item'>Precio con iva: $.$p_civa</li>
      <li class='list-group-item'>Peso: $peso$unit</li>
      <li class='list-group-item'>Stock: $existencia</li>
      <li class='list-group-item'>Ultimo Movimiento: $fecha</li>
     
      </div>
  
   
     <div class='d-flex justify-content-center m-2 modal-body'>
     </div>  
      ";
    }
  }
  else
  {
     echo EmptyPage('Hubo Un Problema con el Producto Seleccionado.');
  }
}