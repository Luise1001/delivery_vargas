<?php

function editar_comercio()
{
  include_once '../conexion.php';
  if(isset($_POST['tipo_id']) && isset($_POST['rif']) && isset($_POST['razon_social']) && isset($_POST['telefono']))
  {
    $admin = $_SESSION['DLV']['admin'];
    $id_usuario = UserID($admin);
    $tipo_id = $_POST['tipo_id'];
    $rif = $_POST['rif'];
    $razon_social = $_POST['razon_social'];
    $telefono = $_POST['telefono'];
    $fecha = CurrentDate();
    $movimiento = CurrentTime();
    $comercio_existe = ComercioRIf($id_usuario);
    
  
    $razon_social = filter_var($razon_social, FILTER_SANITIZE_STRING);
    $tipo_id = filter_var($tipo_id, FILTER_SANITIZE_STRING);
    $rif = filter_var($rif, FILTER_SANITIZE_STRING);
    $telefono = filter_var($telefono, FILTER_SANITIZE_STRING);
  
    $razon_social = ucwords($razon_social);
    $id_comercio = ComercioID($rif);
  
    if($comercio_existe)
    {
      if($razon_social && $tipo_id && $rif && $telefono)
      {
        $editsql = 'UPDATE comercios SET Razon_social=?, Rif=?, Tipo_id=?, Telefono=?, U_movimiento=? WHERE Id_usuario=?';
        $editar_sentence = $pdo->prepare($editsql);
        $editar_sentence->execute(array($razon_social, $rif, $tipo_id, $telefono, $movimiento,  $id_usuario));

        $vieja_ruta = "../img/$comercio_existe";
        $nueva_ruta = "../img/$rif";

        if(file_exists($vieja_ruta))
        {
          rename($vieja_ruta, $nueva_ruta);
        }
      }
    }
    else
    {
      if($id_usuario)
      {
        if($razon_social && $tipo_id && $rif && $telefono)
        {
          $insert_sql = 'INSERT INTO comercios (Id_usuario, Tipo_id, Rif, Razon_social, Telefono, Fecha) VALUES (?,?,?,?,?,?)';
          $sent = $pdo->prepare($insert_sql);
          $sent->execute(array($id_usuario, $tipo_id, $rif, $razon_social, $telefono, $fecha ));
  
          $id_comercio = ComercioID($rif);
  
          return $id_comercio;
        }
  
      }
      else
      {
        echo 'No se Pudo Registrar el comercio, Usuario no registrado';
      }
    }
  
    return $id_comercio;
  }

}