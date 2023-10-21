<?php

function CheckClient()
{
   include_once '../conexion.php';
   $admin =  $_SESSION['DLV']['admin'];
   $UserID = UserID($admin);
   $AdminLevel = AdminLevel($UserID);
   $ClientData = ClientData($UserID);

   if($ClientData)
   {
      echo true;
   }
   else
   {
      echo false;
   }
}

function lista_de_clientes()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $ClientList = ClientList();
  $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
  $respuesta = 
  [
    'titulo'=> $back_btn.'CLIENTES',
    'clientes'=> ''
  ];

  if($ClientList)
  {
    foreach($ClientList as $cliente)
    {
       $id_cliente = $cliente['Id'];
       $id_usuario = $cliente['Id_usuario'];
       $nombre = $cliente['Nombre'];
       $apellido = $cliente['Apellido'];
       $tipo_id = $cliente['Tipo_id'];
       $cedula = $cliente['Cedula'];
       $telefono = $cliente['Telefono'];
       $fecha = DateFormat($cliente['Fecha']);
       $actualizado = $cliente['Actualizado'];
       $fecha_actual = CurrentTime();
       $actualizado = TimeDifference($actualizado, $fecha_actual);
       $foto = SearchProfilePhoto($id_usuario);
       $MyStaticLocations = MyStaticLocations($id_usuario);
       
       $respuesta['clientes'] .= 
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
         <div class='card-list-title'>$nombre $apellido</div>
         <div class='list-text'>
         <div> $telefono <a class='list-link' href='https://wa.me/$telefono' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
         ";
 
         if($MyStaticLocations)
         {
           foreach($MyStaticLocations as $location)
           {
               $location_name = $location['Nombre'];
               $ubicacion = $location['Ubicacion'];
   
               $respuesta['clientes'] .=
               "
               <div><a class='list-link' href='https://www.google.com/maps/place/$ubicacion' target='_blank'>$location_name <i class='fa-solid fa-location-dot'></i></a></div>
               ";
           }
         }
 
         $respuesta['clientes'] .=
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
     $respuesta['clientes'] =  EmptyPage('Sin Clientes Para Mostrar.');
  }

  echo json_encode($respuesta);
}
