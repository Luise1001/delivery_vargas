<?php

function eliminar_direccion()
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

    if(isset($_POST['id_direccion']))
    {
      $id_direccion = $_POST['id_direccion'];

      $deletesql = 'DELETE FROM static_locations WHERE Id=? AND Id_usuario=?';
      $sentenceDelete = $pdo->prepare($deletesql);
      if($sentenceDelete-> execute(array($id_direccion, $UserID)))
      {
        $respuesta =
        [
           'titulo'=> 'Operación Exitosa',
           'cuerpo'=> '',
           'accion'=> 'success'
        ];
      }  
      else
      {
         $respuesta['cuerpo'] = 'No Pudimos Procesar Su Solicitud';
      } 

      echo json_encode($respuesta);
    }

}