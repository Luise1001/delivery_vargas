<?php

function eliminar_conductor()
{
    include_once '../conexion.php';

    $respuesta = 
    [
        'titulo'=> 'Ups',
        'cuerpo'=> 'No Pudimos Procesar Su Solicitud',
        'accion'=> 'warning'
    ];

    if(isset($_POST['id_conductor']))
    {
        $id_conductor = $_POST['id_conductor'];

        $deletesql = 'DELETE FROM conductores WHERE Id=?';
        $sentenceDelete = $pdo->prepare($deletesql);
        if($sentenceDelete-> execute(array($id_conductor)))
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