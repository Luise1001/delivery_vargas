<?php

function eliminar_datos_bancarios()
{
    include_once '../conexion.php';

    if(isset($_POST['id']) && isset($_POST['id_comercio']) && isset($_POST['tabla']))
    {
        $id = $_POST['id'];
        $id_comercio = $_POST['id_comercio'];
        $tabla = $_POST['tabla'];

        if($tabla === 'pm')
        {
            $deletesql = 'DELETE FROM pago_movil WHERE Id=? AND Id_comercio=?';
            $sentenceDelete = $pdo->prepare($deletesql);
            $sentenceDelete-> execute(array($id, $id_comercio)); 
        }

        if($tabla === 'tr')
        {
            $deletesql = 'DELETE FROM transferencia WHERE Id=? AND Id_comercio=?';
            $sentenceDelete = $pdo->prepare($deletesql);
            $sentenceDelete-> execute(array($id, $id_comercio)); 
        }
        if($tabla === 'zelle')
        {
            $deletesql = 'DELETE FROM zelle WHERE Id=? AND Id_comercio=?';
            $sentenceDelete = $pdo->prepare($deletesql);
            $sentenceDelete-> execute(array($id, $id_comercio)); 
        }
    }
}