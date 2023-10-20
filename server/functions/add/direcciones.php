<?php

function nueva_direccion()
{
  include_once '../conexion.php';
  $fecha = CurrentDate();
  $admin = $_SESSION['DLV']['admin'];
  $id_usuario = UserID($admin);

  $lat = $_POST['lat'];
  $lng = $_POST['lng'];
  $ubicacion = $_POST['direction'];
  $nombre = $_POST['name'];
  $nombre = ucwords($nombre);

  $location_id = LocationID($id_usuario);

  if ($lat && $lng && $ubicacion) {
    $insert_sql = 'INSERT INTO static_locations (Nombre, Latitude, Longitude, Ubicacion, Id_usuario, Fecha) VALUES (?,?,?,?,?,?)';
    $sent = $pdo->prepare($insert_sql);
    $sent->execute(array($nombre, $lat, $lng, $ubicacion, $id_usuario, $fecha));
  } else {
    return 'No se Pueden Registrar Datos Vacíos.';
  }
}

function mi_ubicacion_actual()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $respuesta =
    [
      'titulo' => 'Ups',
      'cuerpo' => '',
      'accion' => 'warning',
      'folder' => ProcessLevel($AdminLevel)
    ];

  if (isset($_POST['lat']) && isset($_POST['lng']) && isset($_POST['name'])) {
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $ubicacion = $_POST['name'];
    $actualizado = CurrentTime();
    $fecha = CurrentDate();
    $LocationID = LocationID($UserID);

    if ($lat && $lng && $ubicacion) {
      if ($LocationID) {
        $editsql = 'UPDATE locations SET Latitude =?, Longitude=?, Ubicacion=?, Actualizado=?  WHERE Id_usuario=?';
        $editar_sentence = $pdo->prepare($editsql);
        if ($editar_sentence->execute(array($lat, $lng, $ubicacion, $actualizado, $UserID))) {
          $respuesta =
            [
              'titulo' => 'Operación Exitosa',
              'cuerpo' => '',
              'accion' => 'success',
              'folder' => ProcessLevel($AdminLevel)
            ];
        } else {
          $respuesta['cuerpo'] = 'No Pudimos Procesar Su Solicitud';
        }
      } else {
        $insert_sql = 'INSERT INTO locations (Latitude, Longitude, Ubicacion, Id_usuario, Fecha) VALUES (?,?,?,?,?)';
        $sent = $pdo->prepare($insert_sql);
        if ($sent->execute(array($lat, $lng, $ubicacion, $UserID, $fecha))) {
          $respuesta =
            [
              'titulo' => 'Operación Exitosa',
              'cuerpo' => '',
              'accion' => 'success',
              'folder' => ProcessLevel($AdminLevel)
            ];
        } else {
          $respuesta['cuerpo'] = 'No Pudimos Procesar Su Solicitud';
        }
      }
    }
    else
    {
      $respuesta['cuerpo'] = 'No Se Pueden Guardar Campos Vacíos';
    }

    echo json_encode($respuesta);
  }
}
