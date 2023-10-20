<?php

function editar_cliente($UserID, $nombre, $apellido, $tipo_id, $cedula, $telefono, $genero, $actualizado)
{
   require '../conexion.php';
  $editsql = 'UPDATE clientes SET Nombre=?, Apellido=?, Tipo_id=?, Cedula=?, Telefono=?, Genero=?, Actualizado=?  WHERE Id_usuario=?';
  $editar_sentence = $pdo->prepare($editsql);
  if($editar_sentence->execute(array($nombre, $apellido, $tipo_id, $cedula, $telefono, $genero, $actualizado, $UserID)))
  {
    return true;
  }
  else
  {
     return false;
  }
}

function editar_comercio($UserID, $razon_social, $tipo_id, $rif, $telefono, $actualizado)
{
   require '../conexion.php';
  $editsql = 'UPDATE comercios SET Razon_social=?, Tipo_id=?, Rif=?, Telefono=?, Actualizado=?  WHERE Id_usuario=?';
  $editar_sentence = $pdo->prepare($editsql);
  if($editar_sentence->execute(array($razon_social, $tipo_id, $rif, $telefono, $actualizado, $UserID)))
  {
    return true;
  }
  else
  {
     return false;
  }
}

function editStock($id_comercio, $id_producto, $cantidad)
{
   require '../conexion.php';
   $actualizado = CurrentTime();

   $editsql = 'UPDATE inventario SET Existencia=?, Actualizado=?  WHERE Id_producto=? AND Id_comercio=?';
   $editar_sentence = $pdo->prepare($editsql);
   if($editar_sentence->execute(array($cantidad, $actualizado, $id_producto, $id_comercio)))
   {
     return true;
   }
   else
   {
     return false;
   }
}

function EditDataBank($tabla, $titular, $tipo_id, $documento, $id_banco, $tipo_cuenta, $cuenta, $id)
{

    require '../conexion.php';
    $actualizado = CurrentTime();

    $tabla = filter_var($tabla, FILTER_UNSAFE_RAW);
    $titular = filter_var($titular, FILTER_UNSAFE_RAW);
    $tipo_id = filter_var($tipo_id, FILTER_UNSAFE_RAW);
    $documento = filter_var($documento, FILTER_UNSAFE_RAW);
    $id_banco = filter_var($id_banco, FILTER_UNSAFE_RAW);
    $tipo_cuenta = filter_var($tipo_cuenta, FILTER_UNSAFE_RAW);
    $cuenta = filter_var($cuenta, FILTER_UNSAFE_RAW);
    $id = filter_var($id, FILTER_UNSAFE_RAW);

    if($tabla != 'zelle')
    {
      $editsql = "UPDATE $tabla SET Tipo_id=?, Documento=?, Id_banco=?, $tipo_cuenta=?, Actualizado=?   WHERE Id=?";
      $editar_sentence = $pdo->prepare($editsql);
      if($editar_sentence->execute(array($tipo_id, $documento, $id_banco, $cuenta, $actualizado, $id)))
      {
         return true;
      }
      else
      {
         return false;
      }
    }
    else
    {
      $editsql = "UPDATE $tabla SET Titular=?, $tipo_cuenta=?, Actualizado=?   WHERE Id=?";
      $editar_sentence = $pdo->prepare($editsql);
      if($editar_sentence->execute(array($titular, $cuenta, $actualizado, $id)))
      {
         return true;
      }
      else
      {
         return false;
      }
    }



}