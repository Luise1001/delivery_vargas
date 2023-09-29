<?php

function editar_producto()
{
  include_once 'conexion.php';
  if(isset($_POST['peso']) && isset($_POST['descripcion']) && isset($_POST['precio_civa']) && isset($_POST['id_producto']) && isset($_POST['codigo']))
  {
    $id_usuario = UserID($_SESSION['admin']);
    $rif_comercio = ComercioRif($id_usuario);
    $id_comercio = ComercioID($rif_comercio);
    $moneda = 'Dolar';
    $id_moneda = MonedaID($moneda);
    $alicuota = Alicuota($id_moneda);
    $movimiento = CurrentTime();
  
    $peso = $_POST['peso'];
    $descripcion = $_POST['descripcion'];
    $precio_civa = $_POST['precio_civa'];
    $exento = $_POST['exento'];
    $cantidad = $_POST['cantidad'];
    $id_producto = $_POST['id_producto'];
    $codigo = $_POST['codigo'];
  
    $id_producto = filter_var($id_producto, FILTER_SANITIZE_STRING);
    $codigo = filter_var($codigo, FILTER_SANITIZE_STRING);
    $cantidad = filter_var($cantidad, FILTER_SANITIZE_STRING);
    $peso = filter_var($peso, FILTER_SANITIZE_STRING);
    $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING);
    $precio_civa = filter_var($precio_civa, FILTER_SANITIZE_STRING);
    $exento = filter_var($exento, FILTER_SANITIZE_STRING);
    
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
  
    $editsql = 'UPDATE productos SET Peso=?, Descripcion=?, P_siva=?, P_civa=?, Alicuota=?, U_movimiento=? WHERE Id=?';
    $editar_sentence = $pdo->prepare($editsql);
    $editar_sentence->execute(array($peso, $descripcion, $precio_siva, $precio_civa, $alicuota, $movimiento, $id_producto));
  
    $stock = editStock($id_comercio, $id_producto, $cantidad);
  
    if($_FILES)
    {
      $ruta = ProductImg($rif_comercio, $codigo, $_FILES);
    }
  
  }

}

function editStock($id_comercio, $id_producto, $cantidad)
{
   require 'conexion.php';
   $movimiento = CurrentTime();

   $editsql = 'UPDATE inventario SET Existencia=?, U_movimiento=?  WHERE Id_producto=? AND Id_comercio=?';
   $editar_sentence = $pdo->prepare($editsql);
   $editar_sentence->execute(array($cantidad, $movimiento, $id_producto, $id_comercio));

   return;
}