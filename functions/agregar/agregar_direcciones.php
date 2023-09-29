<?php

function nueva_direccion()
{
  include_once 'conexion.php';
  $fecha = CurrentDate();
  $id_usuario = UserID($_SESSION['admin']);

  $lat = $_POST['lat'];
  $lng = $_POST['lng'];
  $ubicacion = $_POST['direction'];
  $nombre = $_POST['name'];

  $location_id = LocationID($id_usuario);

  if($lat && $lng && $ubicacion)
 {
   $insert_sql = 'INSERT INTO static_locations (Nombre, Latitude, Longitude, Ubicacion, Id_usuario, Fecha) VALUES (?,?,?,?,?,?)';
   $sent = $pdo->prepare($insert_sql);
   $sent->execute(array($nombre, $lat, $lng, $ubicacion, $id_usuario, $fecha));
  }
 else
 {
    return 'No se Pueden Registrar Datos Vacíos.';
  }
}

function mi_ubicacion_actual()
{
  include_once 'conexion.php';
  $fecha = CurrentDate();
  $id_usuario = UserID($_SESSION['admin']);
  $movimiento = CurrentTime();

  $lat = $_POST['lat'];
  $lng = $_POST['lng'];
  $ubicacion = $_POST['name'];

  $location_id = LocationID($id_usuario);

  if($location_id)
  {
    if($lat && $lng && $ubicacion)
    {
      $editsql = 'UPDATE locations SET Latitude =?, Longitude=?, Ubicacion=?, U_movimiento=?  WHERE Id_usuario=?';
      $editar_sentence = $pdo->prepare($editsql);
      $editar_sentence->execute(array($lat, $lng, $ubicacion, $movimiento, $id_usuario));
    }
    else
    {
      return 'No se Pueden Registrar Datos Vacíos.';
    }

  }
  else
  {
    if($lat && $lng && $ubicacion)
    {
      $insert_sql = 'INSERT INTO locations (Latitude, Longitude, Ubicacion, Id_usuario, Fecha) VALUES (?,?,?,?,?)';
      $sent = $pdo->prepare($insert_sql);
      $sent->execute(array($lat, $lng, $ubicacion, $id_usuario, $fecha));
    }
    else
    {
      return 'No se Pueden Registrar Datos Vacíos.';
    }

  }


}