<?php

function lista_de_conductores()
{  
    include_once '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $UserID =  UserID($admin);
    $AdminLevel = AdminLevel($UserID);
    $DriverList = DriverList();
    $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
    $respuesta = 
    [
      'titulo'=> $back_btn.'CONDUCTORES',
      'conductores'=> '',
    ];

    if($DriverList)
    {
      foreach($DriverList as $conductor)
      {
          $id = $conductor['Id'];
          $id_usuario = $conductor['Id_usuario'];
          $nombre = $conductor['Nombre'];
          $apellido = $conductor['Apellido'];
          $tipo_id = $conductor['Tipo_id'];
          $cedula =  $conductor['Cedula'];
          $telefono = $conductor['Telefono'];
          $direccion = $conductor['Direccion'];
          $estado = $conductor['Disponible'];
          $fecha = DateFormat($conductor['Fecha']);
          $actualizado = $conductor['Actualizado'];
          $fecha_actual = CurrentTime();
          $actualizado = TimeDifference($actualizado, $fecha_actual);
          $foto = SearchProfilePhoto($id_usuario);

          if($estado)
          {
             $estado = "<i class='fa-solid fa-check'></i>";
          }
          else
          {
            $estado = "<i class='fa-solid fa-ban text-danger'></i>";
          }

          $respuesta['conductores'] .= 
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
            <div class='card-list-title'>$nombre $apellido $estado</div>
            <div class='list-text'>
            <div>$tipo_id-$cedula</div>
            <div>$telefono  <a class='list-link' href='https://wa.me/$telefono' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div class='list-links'>
            <a class='list-link' href='editar_conductor?conductor=$id&usuario=$id_usuario'>Editar</a>
             <a class='list-link eliminar-conductor' conductor='$id'>Eliminar </a>
              </div>
            </div>
          </div>
        </div>
        </div>
        ";
      }
    }
    else
    {
       $respuesta['conductores'] = EmptyPage('Sin Conductores en la Base de Datos.');
    }

  echo json_encode($respuesta);
}

function detalle_conductor()
{
   include_once '../conexion.php';
   $admin = $_SESSION['DLV']['admin'];
   $UserID = UserID($admin);
   $AdminLevel = AdminLevel($UserID);
   $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
   $respuesta = 
   [
     'titulo'=> $back_btn.'EDITAR CONDUCTOR',
     'conductor'=> '',
   ];

   if(isset($_POST['id_usuario']) && isset($_POST['id_conductor']))
   {
      $id_usuario = $_POST['id_usuario'];
      $id_conductor = $_POST['id_conductor'];
      $DriverData = DriverData($id_usuario);

      if($DriverData)
      {
        foreach($DriverData as $driver)
        {
           $nombre = $driver['Nombre'];
           $apellido = $driver['Apellido'];
           $correo = $driver['Correo'];
           $tipo_id = $driver['Tipo_id'];
           $cedula = $driver['Cedula'];
           $telefono = $driver['Telefono'];
           $direccion = $driver['Direccion'];
        }

        $respuesta['conductor'] =
        "
        <div class='personal-data'>
        <label class='form-label' for='nombre'>Nombres<span class='text-danger'>*</span></label>
        <input class='form-control perfil-input' type='text' id='nombre' name='nombre' value='$nombre'>
        <label class='form-label' for='apellido'>Apellidos<span class='text-danger'>*</span></label>
        <input class='form-control perfil-input' type='text' id='apellido' name='apellido' value='$apellido'>
        <label class='form-label' for='cedula'>Cédula de Identidad<span class='text-danger'>*</span></label>
        <div class='input-group'>
          <select class='form-select perfil-select' id='tipo_id' name='tipo_id'>
            <option value='$tipo_id'>$tipo_id</option>
          </select>
          <input class='form-control perfil-input' type='number' id='cedula' name='cedula' value='$cedula'>
        </div>
        <label class='form-label' for='correo'>Correo Electrónico<span class='text-danger'>*</span></label>
        <input readonly class='form-control perfil-input' type='text' id='correo' name='correo' value='$correo'>
        <label class='form-label' for='telefono'>Celular<span class='text-danger'>*</span></label>
        <input class='form-control perfil-input' type='number' id='telefono' name='telefono' value='$telefono'>
        <label class='form-label' for='direccion'>Dirección<span class='text-danger'>*</span></label>
        <input class='form-control perfil-input' type='text' id='direccion' name='direccion' value='$direccion'>

        <div class='container'>
        <button id='guardar_conductor' class='perfil-button'>Guardar</button>
      </div>
      </div>
      ";

      }
      else
      {
         $respuesta['conductor'] = EmptyPage('Sin Datos Del Conductor');
      }

      echo json_encode($respuesta);
   }
}

function cedula_conductor()
{
   include_once '../conexion.php';
   $respuesta =
   [
     'alert'=> 'El Número De Cédula Debe Estar Registrado Como Conductor',
     'attr'=> 'hidden',
     'status' => true
   ];

   if(isset($_POST['cedula']) && isset($_POST['t']) && isset($_POST['c']))
   {
      $cedula = $_POST['cedula'];
      $table = $_POST['t'];
      $column = $_POST['c'];
      
      $VeryfyDB = VerifyDB($table, $column, $cedula);

      if($VeryfyDB)
      {
        $respuesta =
        [
          'alert'=> '',
          'attr'=> 'hidden',
          'status'=> false
        ];
      }

      echo json_encode($respuesta);

   }
}


function conductores_disponibles()
{
  include_once '../conexion.php';
  
  if(isset($_POST['pedido']))
  {
    $nro_pedido = $_POST['pedido'];
    $id_route = RouteID($nro_pedido);
    $ruta = RouteData($id_route);
    $salida = $ruta[0]['Salida'];
    $lista_de_conductores = DriverListForDelivery(1);

    $conductores = [];
    $i = 0;

    if($lista_de_conductores)
    {
      foreach($lista_de_conductores  as $conductor)
      {
        $ubicacion = $conductor['Ubicacion'];
        $distancia = getDistance($salida, $ubicacion);
        $distancia = round($distancia, 2);
      
        if($i < 5)
        {
          $conductores[$i] =
          [
            'Id' => $conductor[0],
            'Nombre' => $conductor['Nombre'].' '.$conductor['Apellido'],
             'Distancia'=> $distancia
          ];
      
          $i++;
        }
        else
        {
          return;
        }
     
      }
  
      function compareDistance($a, $b) 
      {
       return $a['Distancia'] - $b['Distancia'];
      }
   
     usort($conductores, "compareDistance");
      
     $respuesta = 
     "
      <option value ='0' >Seleccionar </option>
     ";
      foreach($conductores  as $conductor)
      {
         $id = $conductor['Id'];
         $nombre = $conductor['Nombre'];
         $distancia = $conductor['Distancia'];
   
       $respuesta .=
       "
       <option value='$id'>$nombre : $distancia KM.</option>
       ";
      }

    }
    else
    {
      $respuesta = 
      "
       <option value ='0' >Sin Conductores Disponible. </option>
      ";
    }

  }

  echo $respuesta;
  
}