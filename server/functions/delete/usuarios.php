<?php

function eliminar_admin()
{
    include_once '../conexion.php';

    $respuesta = 
    [
      'titulo'=> 'Ups',
      'cuerpo'=> 'No Pudimos Procesar Su Solicitud',
      'accion'=> 'warning'
    ];

    if(isset($_POST['id_usuario']))
    {
        $id_usuario = $_POST['id_usuario'];

        $deletesql = 'DELETE FROM usuarios WHERE Id=?';
        $sentenceDelete = $pdo->prepare($deletesql);
        if($sentenceDelete-> execute(array($id_usuario)))
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