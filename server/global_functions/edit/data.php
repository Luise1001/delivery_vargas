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