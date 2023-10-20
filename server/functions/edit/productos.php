<?php

function editar_producto()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $respuesta = 
  [
    'titulo'=> 'Ups',
    'cuerpo'=> '',
    'accion'=> 'warning'
  ];

  if(isset($_POST['id_producto']) && isset($_POST['descripcion']) && isset($_POST['peso']) && isset($_POST['precio']) 
  && isset($_POST['cantidad']) && isset($_POST['exento']) && isset($_POST['codigo']))
  {
    $ComercioData = ComercioData($UserID);
    $id_comercio = $ComercioData[0]['Id'];
    $id_producto = $_POST['id_producto'];
    $descripcion = $_POST['descripcion'];
    $peso = $_POST['peso'];
    $pciva = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $exento = $_POST['exento'];
    $codigo = $_POST['codigo'];
    $actualizado = CurrentTime();

    if($exento)
    {
      $psiva = round($pciva / 1.16, 2);
    }
    else
    {
       $psiva = $pciva;
    }
    
  
    $id_producto = filter_var($id_producto, FILTER_SANITIZE_NUMBER_INT);
    $codigo = filter_var($codigo, FILTER_UNSAFE_RAW);
    $cantidad = filter_var($cantidad, FILTER_UNSAFE_RAW);
    $peso = filter_var($peso, FILTER_SANITIZE_NUMBER_FLOAT);
    $descripcion = filter_var($descripcion, FILTER_UNSAFE_RAW);
    $pciva = filter_var($pciva, FILTER_UNSAFE_RAW);
    $psiva = filter_var($psiva, FILTER_UNSAFE_RAW);
    $exento = filter_var($exento, FILTER_UNSAFE_RAW);
    
  
    $editsql = 'UPDATE productos SET Peso=?, Descripcion=?, P_siva=?, P_civa=?, Alicuota=?, Actualizado=? WHERE Id=?';
    $editar_sentence = $pdo->prepare($editsql);
    if($editar_sentence->execute(array($peso, $descripcion, $psiva, $pciva, $exento, $actualizado, $id_producto)))
    { 
      $stock = editStock($id_comercio, $id_producto, $cantidad);


        if(isset($_FILES['file']))
        {
          $ProductImg = ProductImg($id_comercio, $codigo, $_FILES);
        }
        

        $respuesta = 
        [
          'titulo'=> 'Operación Exitosa',
          'cuerpo'=> '',
          'accion'=> 'success'
        ];
    }
    else
    {
       $respuesta['cuerpo'] = 'Ocurrió Un Error Editando El Producto';
    }
  
    
    echo json_encode($respuesta);
  
  }

}

