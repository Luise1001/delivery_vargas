<?php

function catalogo_productos()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
  $respuesta =
    [
      'titulo' => $back_btn . 'DELIVERY VARGAS',
      'productos' => ''
    ];

  if (isset($_POST['id_comercio'])) {
    $id_comercio = $_POST['id_comercio'];
    $id_comercio = filter_var($id_comercio, FILTER_SANITIZE_URL);
    $ListProducts = ListProducts($id_comercio);

    if ($ListProducts) {
      foreach ($ListProducts as $product) {
        $id_producto = $product['Id_producto'];
        $codigo = $product['Codigo'];
        $descripcion = $product['Descripcion'];
        $precio = $product['P_civa'];
        $existencia = $product['Existencia'];
        $foto = SearchProductPhoto($id_comercio, $product['Codigo']);
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
          <div>
          <button id='add_to_car_$codigo' codigo='$codigo' producto='$id_producto' comercio='$id_comercio' 
          class='add-to-car-button'>
          <i class='fa-solid fa-circle-plus'></i>
          </button>

            <div id='plus_less_$codigo' codigo='$codigo' hidden class='product-buttons'>
            <button id='less_$codigo' codigo='$codigo' producto='$id_producto' comercio='$id_comercio' class='less-button'>
            <i class='fa-solid fa-circle-minus'></i>
            </button>
           <span id='span_quantity_$codigo' class='span-quantity'>1</span>
           <button id='plus_$codigo' codigo='$codigo' producto='$id_producto' comercio='$id_comercio' class='plus-button'>
           <i class='fa-solid fa-circle-plus'></i>
           </button>
           </div>
           </div>
        </div>
          ";
      }
    } else {
      $respuesta['productos'] = EmptyPage('Sin Productos Disponibles');
    }

    echo json_encode($respuesta);
  }
}

function mis_productos()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
  $mis_productos =
    [
      'titulo' => $back_btn . ' MIS PRODUCTOS',
      'productos' => ''
    ];

  $ComercioData = ComercioData($UserID);
  $id_comercio = $ComercioData[0]['Id'];
  $MyProductsCommerce = MyProductsCommerce($id_comercio);

  if ($MyProductsCommerce) {
    foreach ($MyProductsCommerce as $producto) {

      $id_producto = $producto['Id_producto'];
      $existencia = $producto['Existencia'];
      $bg_color = ProcessBadge($existencia);
      $descripcion = $producto['Descripcion'];
      $pciva = $producto['Pciva'];
      $psiva = $producto['Psiva'];
      $codigo = $producto['Codigo'];
      $actualizado = $producto['Actualizado'];
      $foto = SearchProductPhoto($id_comercio, $codigo);


      $mis_productos['productos'] .=
      "
      <div class='item-grid'>
      <div class='img-grid'>
      <img class='img-product' src='$foto' class='card-img-top' alt='Nuevo Producto'>
      </div>
      <div class='item-grid-body'>
        <h5 class='item-grid-title'>$descripcion <span class='badge my-product-badge $bg_color'>$existencia</span></h5>
        <p class='item-grid-text'>$$pciva</p>
      </div>
      <div class='button-grid'>
      <a href='ver_producto?producto=$id_producto' class='edit-product-button'>Editar</a href='editar_producto?producto=$id_producto'>
      <button comercio='$id_comercio' codigo='$codigo' producto='$id_producto' class='delete-product-button'>Eliminar</button>
      </div>
    </div>

      ";
    }
  } else {
    $mis_productos['productos'] = EmptyPage('Sin Productos Por El Momento.');
  }

  echo json_encode($mis_productos);
}

function buscar_producto()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $respuesta = 
  [
    'productos'=> ''
  ];
  
  if(isset($_POST['buscar']))
  {
    $buscar = $_POST['buscar'];

    if($buscar)
    {
      if(isset($_POST['id_comercio']))
      {
        $id_comercio = $_POST['id_comercio'];

        $SearchProductsByBusiness = SearchProductsByBusiness($buscar, $id_comercio);

        if($SearchProductsByBusiness)
        {
          foreach($SearchProductsByBusiness as $product)
          {
             $id_comercio = $product['Id_comercio'];
             $id_producto = $product['Id'];
             $codigo = $product['Codigo'];
             $descripcion = $product['Descripcion'];
             $precio = $product['P_civa'];
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
             <div>
             <button id='add_to_car_$codigo' codigo='$codigo' producto='$id_producto' comercio='$id_comercio' 
             class='add-to-car-button'>
             <i class='fa-solid fa-circle-plus'></i>
             </button>
   
               <div id='plus_less_$codigo' codigo='$codigo' hidden class='product-buttons'>
               <button id='less_$codigo' codigo='$codigo' producto='$id_producto' comercio='$id_comercio' class='less-button'>
               <i class='fa-solid fa-circle-minus'></i>
               </button>
              <span id='span_quantity_$codigo' class='span-quantity'>1</span>
              <button id='plus_$codigo' codigo='$codigo' producto='$id_producto' comercio='$id_comercio' class='plus-button'>
              <i class='fa-solid fa-circle-plus'></i>
              </button>
              </div>
              </div>
           </div>
           ";
          }
        }
      }
      else
      {
        $SearchProducts = SearchProducts($buscar);

        if($SearchProducts)
        {
            foreach($SearchProducts as $product)
            {
               $id_comercio = $product['Id_comercio'];
               $codigo = $product['Codigo'];
               $descripcion = $product['Descripcion'];
               $foto = SearchProductPhoto($id_comercio, $codigo);
               
               $respuesta['productos'] .=
               "
               <div class='item-grid'>
               <div class='img-grid'>
               <img class='img-product' src='$foto' class='card-img-top' alt='Nuevo Producto'>
               </div>
               <div class='item-grid-body'>
                 <h5 class='item-grid-title'>$descripcion</h5>
                 <p class='item-grid-text'>$$</p>
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
           $respuesta['productos'] = EmptyPage('Sin Resultados');
        }
      }
    }
   echo json_encode($respuesta);

  }
}

function ver_producto()
{
   include_once '../conexion.php';
   $admin = $_SESSION['DLV']['admin'];
   $UserID = UserID($admin);
   $AdminLevel = AdminLevel($UserID);

   if($AdminLevel != '3')
   {
    $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
    $respuesta = 
    [
      'titulo'=> $back_btn.'VER PRODUCTO',
      'producto' => ''
    ];
   }
   else
   {
    $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
    $respuesta = 
    [
      'titulo'=> $back_btn.'EDITAR PRODUCTO',
      'producto' => ''
    ];

    if(isset($_POST['id_producto']))
    {
       $id_producto = $_POST['id_producto'];
       $SearchProduct = SearchProduct($id_producto);

       if($SearchProduct)
       {
         foreach ($SearchProduct as $product) 
         {
           $id_producto = $product['Id_producto'];
           $id_comercio = $product['Id_comercio'];
           $codigo = $product['Codigo'];
           $descripcion = $product['Descripcion'];
           $alicuota = $product['Alicuota'];
           $peso = $product['Peso'];
           $psiva = $product['Psiva'];
           $pciva = $product['Pciva'];
           $existencia = $product['Existencia'];
           $foto = SearchProductPhoto($id_comercio, $codigo);
    
           if($alicuota)
           {
            $yes = '';
            $no = 'checked';
           }
           else
           {
            $yes = 'checked';
            $no = '';
           }

            $respuesta['producto']  =
            "
            <div class='header-producto'>
            <img id='img_producto' src='$foto' alt='$codigo'>
            <input  type='file' accept='image/*' id='foto_producto' class='file-selector'>
            <label for='foto_producto' class='file-selector-label'>
            <span class='file-selector-span'><i class='fas fa-camera'></i></span>
            </label>
            </div>
            <div class='product-detail'>
            <label class='form-label' for='codigo'>Codigo<span class='text-danger'>*</span></label>
            <input readonly class='form-control ' type='text' id='codigo' name='codigo' value='$codigo'>
            <label class='form-label' for='descripcion'>Descripcion<span class='text-danger'>*</span></label>
            <input class='form-control ' type='text' id='descripcion' name='descripcion' value='$descripcion'>
            <label class='form-label' for='precio'>Precio<span class='text-danger'>*</span></label>
            <input class='form-control ' type='text' id='precio' name='precio' value='$pciva'>
            <label class='form-label' for='exento'>Exento<span class='text-danger'>*</span></label>
            <div class='exento'>
            <div class='form-check'>
            <input $yes class='form-check-input' value='0' type='radio' id='ex_yes' name='exento'>
            <label class='form-check-label' for='ex_yes'>
              Si
            </label>
          </div>
          <div class='form-check'>
          <input $no class='form-check-input' value='$alicuota' type='radio' id='ex_no' name='exento'>
          <label class='form-check-label' for='ex_no'>
            No
          </label>
        </div>
            </div>
            <label class='form-label' for='peso'>Peso Kg.<span class='text-danger'>*</span></label>
            <input class='form-control ' type='text' id='peso' name='peso' value='$peso'>
            <label class='form-label' for='stock'>Existencia<span class='text-danger'>*</span></label>
            <input class='form-control ' type='number' id='stock' name='stock' value='$existencia'>
            <div class='container'>
              <button id='guardar_producto' class='perfil-button'>Guardar</button>
            </div>
          </div>
          ";
         }
       }
       else
       {
         $respuesta['producto'] = EmptyPage('Producto No Encontrado');
       }
    }
   }

   echo json_encode($respuesta);
}

function CheckCode()
{
   include_once '../conexion.php';
   $admin = $_SESSION['DLV']['admin'];
   $UserID = UserID($admin);
   $AdminLevel = AdminLevel($UserID);
   $respuesta = 
   [
     'codigo' => ''
   ];

   if($AdminLevel === '3')
   {
     $ComercioData = ComercioData($UserID);
     $id_comercio = $ComercioData[0]['Id'];

     if(isset($_POST['codigo']))
     {
       $codigo = $_POST['codigo'];

       $CodeID = CodeID($codigo, $id_comercio);

       if($CodeID)
       {
         $respuesta['codigo'] = 'Este Codigo ya se Encuentra en Uso.';
       }

       echo json_encode($respuesta);

     }
   }
}