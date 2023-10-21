<?php

function comercios()
{
   include_once '../conexion.php';
   $admin = $_SESSION['DLV']['admin'];
   $UserID = UserID($admin);
   $AdminLevel = AdminLevel($UserID);
   $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
   $respuesta = 
   [
     'titulo'=> $back_btn,
     'comercios'=> ''
   ];
 
   if(isset($_POST['id_categoria']) && isset($_POST['categoria']))
   {
     $id_categoria = $_POST['id_categoria'];
     $categoria = $_POST['categoria'];
     $id_categoria = filter_var($id_categoria, FILTER_SANITIZE_URL);
     $categoria = filter_var($categoria, FILTER_SANITIZE_URL);
     
     $BusinessBYCategory = BusinessByCategory($id_categoria);
     $respuesta['titulo'] .= $categoria;

     if($BusinessBYCategory)
     {
       foreach($BusinessBYCategory as $business)
       {
         $id_usuario = $business['Id_usuario'];
         $id_comercio = $business['Id_comercio'];
         $razon_social = $business['razon_social'];
         $foto = SearchProfilePhoto($id_usuario);

        $respuesta['comercios'] .= 
        "
        <a href='catalogo_productos?comercio=$id_comercio' class='item-grid'>
        <div>
        <img class='img-product' src='$foto' class='card-img-top' alt='Comercio Afiliado'>
        <div class='item-grid-body'>
          <h5 class='item-grid-title'>$razon_social</h5>
          <p class='item-grid-text'></p>
        </div>
      </div>
      </a>
      ";
       }
     }
     else
     {
       $respuesta['comercios'] = EmptyPage('Sin Comercios Disponibles');
     }
   }
   
   
   echo json_encode($respuesta);
}

function lista_de_comercios()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $BusinessList = BusinessList();
  $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
  $respuesta = 
  [
    'titulo'=> $back_btn.'COMERCIOS AFILIADOS',
    'comercios'=> ''
  ];

  if($BusinessList)
  {
    foreach($BusinessList as $comercio)
    {
      $id_usuario = $comercio['Id_usuario'];
      $id_comercio = $comercio['Id'];
      $razon_social = $comercio['Razon_social'];
      $tipo_id = $comercio['Tipo_id'];
      $rif = $comercio['Rif'];
      $telefono = $comercio['Telefono'];
      $fecha = DateFormat($comercio['Fecha']);
      $actualizado = $comercio['Actualizado'];
      $fecha_actual = CurrentTime();
      $actualizado = TimeDifference($actualizado, $fecha_actual);
      $foto = SearchProfilePhoto($id_usuario);
      $MyStaticLocations = MyStaticLocations($id_usuario);

      $respuesta['comercios'] .= 
      "
      <div class='card-list'>
      <div class='card-list-header'>
        <strong class='me-auto'>$fecha</strong>
        <small>$actualizado</small>
      </div>
      <div class='card-list-body'>
        <div class='list-img'>
         <img class='img-list' src='$foto' alt='Foto de Perfil'>
        </div>
        <div class='list-data'>
        <div class='card-list-title'>$razon_social</div>
        <div class='list-text'>
        <div> $telefono <a href='https://wa.me/$telefono' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
        ";

        if($MyStaticLocations)
        {
          foreach($MyStaticLocations as $location)
          {
              $location_name = $location['Nombre'];
              $ubicacion = $location['Ubicacion'];
  
              $respuesta['comercios'] .=
              "
              <div><a class='list-link' href='https://www.google.com/maps/place/$ubicacion' target='_blank'>$location_name <i class='fa-solid fa-location-dot'></i></a></div>
              ";
          }
        }

        $respuesta['comercios'] .=
        "
        </div>
      </div>
    </div>
    </div>
    ";

    }
  }
  else
  {
     $respuesta['comercios'] =  EmptyPage('Sin Comercios Para Mostrar.');
  }

  echo json_encode($respuesta);
}