<?php

function eliminar_moto()
{
    include_once '../conexion.php';
    
    $respuesta =
    [
      'titulo'=> 'Ups',
      'cuerpo'=> 'No Pudimos Procesar Su Solicitud',
      'accion'=> 'warning'
    ];

    if(isset($_POST['id_moto']))
    {
        $id_moto = $_POST['id_moto'];

        $deletesql = 'DELETE FROM motos WHERE Id=?';
        $sentenceDelete = $pdo->prepare($deletesql);
        if($sentenceDelete-> execute(array($id_moto)))
        {
            $respuesta =
            [
              'titulo'=> 'Operación Exitosa',
              'cuerpo'=> '',
              'accion'=> 'success'
            ];
        }

        echo json_encode($respuesta);
    }
}