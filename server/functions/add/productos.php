<?php

function nuevo_producto()
{
  include_once '../conexion.php';

  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $ComercioData = ComercioData($UserID);
  $id_comercio = $ComercioData[0]['Id'];
  $fecha = CurrentDate();
  $respuesta = 
  [
    'titulo'=> 'Ups',
    'cuerpo'=> 'No Pudimos Procesar Su Solicitud',
    'accion'=> 'warning'
  ];

  if (isset($_POST['codigo']) && isset($_POST['descripcion']) && isset($_POST['precio']) && isset($_POST['peso']))
  {
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $pciva = $_POST['precio'];
    $peso = $_POST['peso'];
    $exento = $_POST['exento'];
    $cantidad = $_POST['cantidad'];

    $codigo = filter_var($codigo, FILTER_UNSAFE_RAW);
    $descripcion = filter_var($descripcion, FILTER_UNSAFE_RAW);
    $pciva = filter_var($pciva, FILTER_UNSAFE_RAW);
    $peso = filter_var($peso, FILTER_UNSAFE_RAW);
    $exento = filter_var($exento, FILTER_UNSAFE_RAW);
    $cantidad = filter_var($cantidad, FILTER_UNSAFE_RAW);

    $codigo = ucfirst($codigo);
    $descripcion = ucwords($descripcion);

    if($exento)
    {
       $psiva = round($pciva / 1.16, 2);
    }
    else
    {
       $psiva = $pciva;
    }

    if($codigo && $descripcion && $pciva && $psiva && $peso)
    {
      

        $ProductImg = ProductImg($id_comercio, $codigo, $_FILES);
        $foto = SearchProductPhoto($id_comercio, $codigo);
  
        $insert_sql = 'INSERT INTO productos (Codigo, Descripcion, Foto, P_siva, P_civa, Alicuota, Peso, Id_comercio, Fecha) VALUES (?,?,?,?,?,?,?,?,?)';
        $sent = $pdo->prepare($insert_sql);
        if($sent->execute(array($codigo, $descripcion, $foto, $psiva, $pciva, $exento, $peso, $id_comercio, $fecha)))
        {
          $ProductID = ProductID($id_comercio, $codigo);
          $stock = addStock($id_comercio, $ProductID, $cantidad);
  
          if($stock)
          {
            $respuesta = 
            [
              'titulo'=> 'Excelente',
              'cuerpo'=> 'Continua Publicando Tus Productos',
              'accion'=> 'success'
            ];
          }
        }

    }

    echo json_encode($respuesta);
  }
}

function addStock($id_comercio, $id_producto, $cantidad)
{
  require '../conexion.php';
  $fecha = CurrentDate();

  $insert_sql = 'INSERT INTO inventario (Id_comercio, Id_producto, Existencia, Fecha) VALUES (?,?,?,?)';
  $sent = $pdo->prepare($insert_sql);
  if($sent->execute(array($id_comercio, $id_producto, $cantidad, $fecha)))
  {
     return true;
  }
  else
  {
     return false;
  }
}
