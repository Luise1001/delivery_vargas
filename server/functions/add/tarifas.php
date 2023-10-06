<?php

function nueva_tarifa()
{
  include_once '../conexion.php';
  $fecha = CurrentDate();

  $km = $_POST['km'];
  $precio = $_POST['precio'];

  if($km && $precio)
  {
    $insert_sql = 'INSERT INTO tarifas (KM, Precio, Fecha) VALUES (?,?,?)';
    $sent = $pdo->prepare($insert_sql);
    $sent->execute(array($km, $precio, $fecha));
  }
  else
  {
    return 'No se Pueden Registrar Datos Vacíos.';
  }
}