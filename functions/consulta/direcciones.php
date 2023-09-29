<?php

function mis_direcciones()
{
  include_once 'conexion.php';
  $id_usuario = UserID($_SESSION['admin']);
  $lista_de_direcciones = MyStaticLocations($id_usuario);
  if($lista_de_direcciones)
  {
    $lista_de_direcciones = array_reverse($lista_de_direcciones);
    foreach($lista_de_direcciones as $direccion)
    {
      $id = $direccion['Id'];
      $nombre = $direccion['Nombre'];
      $ubicacion = $direccion['Ubicacion'];
      $fecha = DateFormat($direccion['Fecha']);
  
      echo 
      "
      <div class=' address-card'>
      <div class='card-header'>
      </div>
      <div class='card-body bg-transparent'>
        <ul class='list-group list-group-flush'>
        <li class='list-group-item'><h6><i class='fas fa-map-marker-alt'></i> $nombre</h6></li>
      </ul>

      <div id='detalle_$id' class='dropdown-container'>
      <li class='list-group-item'>$ubicacion </li>
      <a direccion='$id' class='btn eliminar-direccion'>
      <i class='fas fa-trash-alt text-danger'></i>
      </a>

      <a id='$id' nombre='$nombre' class='btn editar-direccion' id='edit_direction'
      data-toggle='modal' data-target='#editar_direccion'>
      <i class='fas fa-edit'></i>
      </a>
      </div>
   
      </div>
      <div class='card-footer text-body-secondary'>
      <a  id='$id' class='btn direccion-detalle'>
      <i class='fas fa-info-circle'></i> Ver Detalle</a>
      </div>
    </div>
      
      ";
    }
  }
  else
  {
     echo EmptyPage('Sin Direcciones Para Mostrar.');
  }

}

function direccion_salida()
{
    require 'conexion.php';

    if(isset($_POST['id_comercio']))
    {
        $id_comercio = $_POST['id_comercio'];
        $comercioData = ComercioData($id_comercio);
        $id_usuario = $comercioData[0]['Id_usuario'];
        $direcciones = MyStaticLocations($id_usuario);
       if($direcciones)
       {
          $id_direccion = $direcciones[0]['Id'];
          $direccion = $direcciones[0]['Ubicacion'];

          echo $direccion;

       }
       else
       {
          echo 'No Se Encontró Dirección de Salida.';
       }


    }

}

function direccion_envio()
{
    require 'conexion.php';
    $id_usuario = UserID($_SESSION['admin']);

    $direcciones = '';
    $mi_ubicacion = MYCurrentLocation($id_usuario);
    $mis_direcciones = MyStaticLocations($id_usuario);

    if($mi_ubicacion)
    {
        foreach($mi_ubicacion as $ubicacion)
        {
            $id_direccion  = $ubicacion['Id'];
            $nombre_direccion = $ubicacion['Ubicacion'];
            $direcciones .= 
            "
            <option  value='$id_direccion'>$nombre_direccion</option> 
            ";
        }
    }


    if($mis_direcciones)
    {
        foreach($mis_direcciones as $direccion)
        {
            $id_direccion = $direccion['Id'];
            $nombre_direccion = $direccion['Nombre'];
            $direcciones .= 
            "
            <option  value='$id_direccion'>$nombre_direccion</option> 
            ";
        }
    }

    echo $direcciones;
}

function nombre_direccion()
{
    include_once 'conexion.php';
    
    if(isset($_POST['id_direccion']))
    {
        $id_usuario = UserID($_SESSION['admin']);
        $id_direccion = $_POST['id_direccion'];
        $direccion = StaticLocationName($id_direccion, $id_usuario);

        echo $direccion;
    }
}