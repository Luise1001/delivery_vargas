<?php

function nuevo_producto()
{
  include_once 'conexion.php';

  $id_usuario = UserID($_SESSION['admin']);
  $rif_comercio = ComercioRif($id_usuario);
  $id_comercio = ComercioID($rif_comercio);
  $fecha = CurrentDate();
  $moneda = 'Dolar';
  $id_moneda = MonedaID($moneda);
  $alicuota = Alicuota($id_moneda);

  $codigo = $_POST['codigo'];
  $peso = $_POST['peso'];
  $descripcion = $_POST['descripcion'];
  $precio_civa = $_POST['precio_civa'];
  $exento = $_POST['exento'];
  $cantidad = $_POST['cantidad'];

  $cantidad = filter_var($cantidad, FILTER_SANITIZE_STRING);
  $codigo = filter_var($codigo, FILTER_SANITIZE_STRING);
  $peso = filter_var($peso, FILTER_SANITIZE_STRING);
  $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING);
  $precio_civa = filter_var($precio_civa, FILTER_SANITIZE_STRING);
  $exento = filter_var($exento, FILTER_SANITIZE_STRING);

  $descripcion = ucwords($descripcion);
  
  if($exento == 1)
  { 
    $precio_siva = number_format($precio_civa, 2);
    $alicuota = 0;
  }
  else
  {
   
    $precio_siva = ($precio_civa) - ($precio_civa * ($alicuota/100));
    $precio_siva = number_format($precio_siva, 2);
  }
   

  if($codigo && $peso && $descripcion && $precio_siva && $precio_civa)
  {
    $insert_sql = 'INSERT INTO productos (Codigo, Descripcion, Foto, P_siva, P_civa, Alicuota, Peso, Id_comercio, Fecha) VALUES (?,?,?,?,?,?,?,?,?)';
    $sent = $pdo->prepare($insert_sql);
    $sent->execute(array($codigo, $descripcion, $codigo, $precio_siva, $precio_civa, $alicuota, $peso, $id_comercio, $fecha));
   
  
    $id_producto = LastProductAdded($id_comercio);
    $stock = addStock($id_comercio, $id_producto, $cantidad);

    $ruta = ProductImg($rif_comercio, $codigo, $_FILES);
  }

}

function addStock($id_comercio, $id_producto, $cantidad)
{
  require 'conexion.php';
  $fecha = CurrentDate();

  $insert_sql = 'INSERT INTO inventario (Id_comercio, Id_producto, Existencia, Fecha) VALUES (?,?,?,?)';
  $sent = $pdo->prepare($insert_sql);
  $sent->execute(array($id_comercio, $id_producto, $cantidad, $fecha));

  return;
}