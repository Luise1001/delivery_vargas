<?php

function eliminar_moto()
{
    include_once '../conexion.php';

    $id_moto = $_POST['id_moto'];

    $deletesql = 'DELETE FROM motos WHERE Id=?';
    $sentenceDelete = $pdo->prepare($deletesql);
    $sentenceDelete-> execute(array($id_moto));
}