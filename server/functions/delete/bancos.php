<?php

function eliminar_datos_bancarios()
{
    include_once '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $AdminLevel = AdminLevel($UserID);
    $ComercioData = ComercioData($UserID);
    $id_comercio = $ComercioData[0]['Id'];
    $respuesta = 
    [
        'titulo'=> 'Ups',
         'cuerpo'=> 'No Pudimos Procesar Su Solicitud',
         'accion'=> 'warning'
    ];

    if(isset($_POST['id']) && isset($_POST['tabla']))
    {
        $id = $_POST['id'];
        $tabla = $_POST['tabla'];

        $deletesql = "DELETE FROM $tabla WHERE Id=? AND Id_comercio=?";
        $sentenceDelete = $pdo->prepare($deletesql);
        if($sentenceDelete-> execute(array($id, $id_comercio)))
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